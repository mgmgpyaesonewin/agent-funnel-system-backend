<?php

namespace App\Listeners;

use App\Applicant;
use App\Events\InviteBOPSession;

class InviteApplicantBOPSession
{
    /**
     * Handle the event.
     */
    public function handle(InviteBOPSession $event)
    {
        $applicant = Applicant::where('id', $event->applicant_id)->first();
        $applicant->bop_sessions()->attach([
            'attendance_status' => 'invited',
        ]);
    }
}
