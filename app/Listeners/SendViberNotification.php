<?php

namespace App\Listeners;

use App\Events\ApplicantUpdating;
use App\Interfaces\ContractInterface;
use App\Setting;

class SendViberNotification
{
    protected $text = 'default text';
    protected $contract;

    public function __construct(ContractInterface $contractInterface)
    {
        $this->contract = $contractInterface;
    }

    /**
     * Handle the event.
     */
    public function handle(ApplicantUpdating $event)
    {
        if ($event->applicant->isDirty('status_id') && 'onboard' == $event->applicant->current_status) {
            $attributes = $event->applicant->getDirty();

            if (7 == $attributes['status_id'] && 1 == $event->applicant->status_id) {
                $contract_version = $this->contract->resendContract($event->applicant->id);
                $route = env('FRONT_END_URL').'/sign/'.$event->applicant->uuid.'?version='.$contract_version;
                $link = $route;
                $this->text = json_decode(Setting::where('meta_key', 'cv_form_msg')->first()->meta_value)->text."{$link}";
                notified_applicant_via_viber($event->applicant->phone, $this->text);
            }
        }

        if ($event->applicant->isDirty('current_status') && 1 == $event->applicant->status_id) {
            $attributes = $event->applicant->getDirty();
            // Stage 3
            if ('pre_filter' == $attributes['current_status'] && 1 == $event->applicant->status_id) {
                $route = env('FRONT_END_URL').'/applicants/'.$event->applicant->uuid;
                $link = $route;
                $this->text = json_decode(Setting::where('meta_key', 'cv_form_msg')->first()->meta_value)->text."{$link}";
                notified_applicant_via_viber($event->applicant->phone, $this->text);
            }

            // Stage 4
            if ('pru_dna_test' == $attributes['current_status'] && 1 == $event->applicant->status_id) {
                $this->text = json_decode(Setting::where('meta_key', 'cv_form_msg')->first()->meta_value)->text;
                notified_applicant_via_viber($event->applicant->phone, $this->text);
            }

            // Stage 9
            if ('onboard' == $attributes['current_status'] && 1 == $event->applicant->status_id) {
                $route = env('FRONT_END_URL').'/login';
                $link = $route;
                $this->text = json_decode(Setting::where('meta_key', 'cv_form_msg')->first()->meta_value)->text.' '.$link;
                notified_applicant_via_viber($event->applicant->phone, $this->text);

                // generate a empty contract to check route is not accessible after he had made the contract
                $contract_version = $this->contract->createRawContract($event->applicant->id);

                $route = env('FRONT_END_URL').'/sign/'.$event->applicant->uuid.'?version='.$contract_version;
                $link = $route;

                $this->text = "Please, sign your contract here: {$link}";
                notified_applicant_via_viber($event->applicant->phone, $this->text);
            }

            // View Payment
            if ('pmli_filter' == $attributes['current_status'] && 1 == $event->applicant->status_id) {
                $route = env('FRONT_END_URL').'/payment/'.$event->applicant->uuid;
                $link = $route;
                $this->text = json_decode(Setting::where('meta_key', 'cv_form_msg')->first()->meta_value)->text.' '.$link;
                notified_applicant_via_viber($event->applicant->phone, $this->text);
            }

            $event->applicant->saveQuietly();
        }
    }
}
