<?php

namespace App\Listeners;

use App\Events\ApplicantUpdating;
use App\Setting;

class SendViberNotification
{
    protected $text = 'default text';

    /**
     * Handle the event.
     */
    public function handle(ApplicantUpdating $event)
    {
        if ($event->applicant->isDirty('current_status') && 1 == $event->applicant->status_id) {
            $attributes = $event->applicant->getDirty();
            // Stage 3
            if ('pre_filter' == $attributes['current_status'] && 1 == $event->applicant->status_id) {
                $route = env('FRONT_END_URL').'/applicants/detail/'.$event->applicant->id;
                $link = $route;
                $this->text = Setting::where('meta_key', 'cv_form_msg')->first()->meta_value."{$link}";
                notified_applicant_via_viber($event->applicant->phone, $this->text);
            }

            // Stage 4
            if ('pru_dna_test' == $attributes['current_status'] && 1 == $event->applicant->status_id) {
                $this->text = Setting::where('meta_key', 'dna_test_msg')->first()->meta_value;
                notified_applicant_via_viber($event->applicant->phone, $this->text);
            }

            // Stage 9
            if ('onboard' == $attributes['current_status'] && 1 == $event->applicant->status_id) {
                $route = env('FRONT_END_URL').'/login';
                $link = $route;
                $this->text = Setting::where('meta_key', 'payment_msg')->first()->meta_value."It will take you to fill your license forms.{$link}";
                notified_applicant_via_viber($event->applicant->phone, $this->text);
            }

            // View Payment
            if ('pmli_filter' == $attributes['current_status'] && 1 == $event->applicant->status_id) {
                $route = env('FRONT_END_URL').'/login';
                $link = $route;
                $this->text = Setting::where('meta_key', 'payment_msg')->first()->meta_value."It will take you to fill your payment forms.{$link}";
                notified_applicant_via_viber($event->applicant->phone, $this->text);
            }

            $event->applicant->saveQuietly();
        }
    }
}
