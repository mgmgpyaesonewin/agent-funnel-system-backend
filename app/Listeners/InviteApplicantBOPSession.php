<?php

namespace App\Listeners;

use App\Applicant;
use App\Events\InviteBopSession;

class InviteApplicantBopSession
{
    /**
     * Handle the event.
     */
    public function handle(InviteBopSession $event)
    {
        $applicant = Applicant::where('id', $event->applicant_id)->first();
        $applicant->bop_sessions()->attach([
            'attendance_status' => 'invited',
        ]);
    }
}
