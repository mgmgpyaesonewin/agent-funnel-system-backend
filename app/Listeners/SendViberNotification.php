<?php

namespace App\Listeners;

use App\Events\ApplicantUpdating;

class SendViberNotification
{
    /**
     * Handle the event.
     */
    public function handle(ApplicantUpdating $event)
    {
        if ($event->applicant->isDirty('current_status') && 1 == $event->applicant->status_id) {
            $attributes = $event->applicant->getDirty();
            if ('pre_filter' == $attributes['current_status'] && 1 == $event->applicant->status_id) {
                $text = 'lead is success';
                notified_applicant_via_viber($text);
                $event->applicant->saveQuietly();
            }
        }
    }
}
