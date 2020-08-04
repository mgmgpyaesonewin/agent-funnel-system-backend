<?php

namespace App\Listeners;

use App\Events\ApplicantUpdating;

class GenerateTemporaryId
{
    /**
     * Handle the event.
     */
    public function handle(ApplicantUpdating $event)
    {
        if ($event->applicant->isDirty('status_id') && 'pmli_filter' == $event->applicant->current_status) {
            $attributes = $event->applicant->getDirty();
            if (3 == $attributes['status_id']) {
                $event->applicant->temp_id = 'PA-MMDD0000'.$event->applicant->id;
                $event->applicant->saveQuietly();
            }
        }
    }
}
