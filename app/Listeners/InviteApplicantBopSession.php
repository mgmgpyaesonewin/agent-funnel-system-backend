<?php

namespace App\Listeners;

use App\Applicant;
use App\Events\InviteBopSession;

class InviteApplicantBopSession
{
    /**
     * Handle the event.
     * @param InviteBopSession $event
     */
    public function handle(InviteBopSession $event)
    {
        $applicant = Applicant::where('id', $event->applicant_id)->first();
        $applicant->bop_sessions()->attach($event->session_id, [
            'attendance_status' => 'invited',
        ]);
    }
}
