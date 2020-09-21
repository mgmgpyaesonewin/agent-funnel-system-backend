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
                $event->applicant->temp_id = 'PA'.Carbon::now()->format('m').Carbon::now()->format('d').str_pad($event->applicant->id, 4, '0', STR_PAD_LEFT);
                $event->applicant->status_id = 1;
                $event->applicant->current_status = 'training';
                $event->applicant->saveQuietly();
                notified_applicant_via_viber($event->applicant->phone, "Your TempID is {$event->applicant->temp_id}");
            }
        }
    }
}
