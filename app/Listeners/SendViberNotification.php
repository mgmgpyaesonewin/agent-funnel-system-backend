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
            if ('pre_filter' == $attributes['current_status'] && 1 == $event->applicant->status_id) {
                $this->text = Setting::where('meta_key', 'cv_form_msg')->first()->meta_value.'Please go to https://www.google.com';
            }

            if ('pru_dna_test' == $attributes['current_status'] && 1 == $event->applicant->status_id) {
                $this->text = Setting::where('meta_key', 'dna_test_msg')->first()->meta_value.'Please go to https://www.google.com';
            }

            notified_applicant_via_viber($event->applicant->phone, $this->text);
            $event->applicant->saveQuietly();
        }
    }
}
