<?php

namespace App\Listeners;

use App\Classes\Viber\ContentType;
use App\Events\ApplicantUpdating;
use App\Interfaces\ContractInterface;
use App\Services\Interfaces\ViberServiceInterface;
use Config;

class SendViberNotification
{
    protected $contract;
    protected $viber;

    public function __construct(ContractInterface $contractInterface, ViberServiceInterface $viberInterface)
    {
        $this->contract = $contractInterface;
        $this->viber = $viberInterface;
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

                $link = env('FRONT_END_URL').'/sign/'.$event->applicant->uuid.'?version='.$contract_version;
                $text = $this->viber->getMetaValueByKey('contract_msg')->text.' '.$link;
                $image = $this->viber->getMetaValueByKey('contract_msg')->image;

                // Set Viber Content
                $viber_content = new ContentType();
                $viber_content->setText($text);
                $viber_content->setImage($image);
                $viber_content->setAction($link);

                $this->viber->send($event->applicant->phone, Config::get('constants.viber.content_type.custom'), $viber_content);
            }
        }

        if ($event->applicant->isDirty('current_status') && 1 == $event->applicant->status_id) {
            $attributes = $event->applicant->getDirty();
            // Stage 3
            if ('pre_filter' == $attributes['current_status'] && 1 == $event->applicant->status_id) {
                $link = env('FRONT_END_URL').'/applicants/'.$event->applicant->uuid;
                $text = $this->viber->getMetaValueByKey('cv_form_msg')->text;
                $image = $this->viber->getMetaValueByKey('cv_form_msg')->image;

                // Set Viber Content
                $viber_content = new ContentType();
                $viber_content->setText($text);
                $viber_content->setImage($image);
                $viber_content->setAction($link);

                $this->viber->send($event->applicant->phone, Config::get('constants.viber.content_type.custom'), $viber_content);
            }

            // Stage 4
            if ('pru_dna_test' == $attributes['current_status'] && 1 == $event->applicant->status_id) {
                $text = $this->viber->getMetaValueByKey('dna_test_msg')->text;

                // Set Viber Content
                $viber_content = new ContentType();
                $viber_content->setText($text);

                $this->viber->send($event->applicant->phone, Config::get('constants.viber.content_type.simple'), $viber_content);
            }

            // Stage 9
            if ('onboard' == $attributes['current_status'] && 1 == $event->applicant->status_id) {
                $link = env('FRONT_END_URL').'/login';
                $text = $this->viber->getMetaValueByKey('license_msg')->text.' '.$link;
                $image = $this->viber->getMetaValueByKey('license_msg')->image;

                // Set Viber Content
                $viber_content = new ContentType();
                $viber_content->setText($text);
                $viber_content->setImage($image);
                $viber_content->setAction($link);

                $this->viber->send($event->applicant->phone, Config::get('constants.viber.content_type.custom'), $viber_content);

                // generate a empty contract to check route is not accessible after he had made the contract
                $contract_version = $this->contract->createRawContract($event->applicant->id);

                $link = env('FRONT_END_URL').'/sign/'.$event->applicant->uuid.'?version='.$contract_version;
                $text = $this->viber->getMetaValueByKey('sign_contract_msg')->text;
                $image = $this->viber->getMetaValueByKey('sign_contract_msg')->image;

                // Set Viber Content
                $viber_content = new ContentType();
                $viber_content->setText($text);
                $viber_content->setImage($image);
                $viber_content->setAction($link);

                $this->viber->send($event->applicant->phone, Config::get('constants.viber.content_type.custom'), $viber_content);
            }

            // View Payment
            if ('pmli_filter' == $attributes['current_status'] && 1 == $event->applicant->status_id) {
                $link = env('FRONT_END_URL').'/payment/'.$event->applicant->uuid;
                $text = $this->viber->getMetaValueByKey('payment_msg')->text.' '.$link;
                $image = $this->viber->getMetaValueByKey('payment_msg')->image;

                // Set Viber Content
                $viber_content = new ContentType();
                $viber_content->setText($text);
                $viber_content->setImage($image);
                $viber_content->setAction($link);

                $this->viber->send($event->applicant->phone, Config::get('constants.viber.content_type.custom'), $viber_content);
            }

            $event->applicant->saveQuietly();
        }
    }
}
