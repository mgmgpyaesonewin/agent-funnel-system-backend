<?php

namespace App\Listeners;

use App\Events\ApplicantUpdating;
use Carbon\Carbon;

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
                $event->applicant->temp_id = 'PA-'.Carbon::now()->format('m').Carbon::now()->format('d').str_pad($event->applicant->id, 4, '0', STR_PAD_LEFT);
                $event->applicant->saveQuietly();
            }
        }
    }
}
