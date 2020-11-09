<?php

namespace App\Listeners;

use App\Classes\Viber\ContentType;
use App\Events\ApplicantUpdating;
use App\Services\Interfaces\ViberServiceInterface;
use App\Setting;
use Config;

class GenerateTemporaryId
{
    protected $viber;

    public function __construct(ViberServiceInterface $viberInterface)
    {
        $this->viber = $viberInterface;
    }

    /**
     * Handle the event.
     */
    public function handle(ApplicantUpdating $event)
    {
        // Generate Temporary ID
        if ($event->applicant->isDirty('status_id') && 'pmli_filter' == $event->applicant->current_status) {
            $attributes = $event->applicant->getDirty();
            if ($this->shouldGenerateTemporaryID($attributes)) {
                $event->applicant->temp_id = 'FA'.str_pad($event->applicant->id, 6, '0', STR_PAD_LEFT);

                if ($attributes['status_id'] == 3) {
                    $event->applicant->status_id = 1;
                    $event->applicant->current_status = 'training';
                }

                $event->applicant->saveQuietly();

                $viber_content = new ContentType();
                $viber_content->setText("Your TempID is {$event->applicant->temp_id}");

                $this->viber->send($event->applicant->phone, Config::get('constants.viber.content_type.simple'), $viber_content);
            }
        }
    }

    public function shouldGenerateTemporaryID($attributes)
    {
        $is_payment_required = Setting::where('meta_key', 'payment_mandatory')
            ->pluck('meta_value')
            ->first();

        if ($is_payment_required) {
            return 11 == $attributes['status_id'];
        }

        return 3 == $attributes['status_id'];
    }
}
