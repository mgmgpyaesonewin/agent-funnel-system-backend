<?php

namespace App\Listeners;

use App\Events\ApplicantUpdating;
use App\User;

class AssignBDMWhenMAisAssigned
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ApplicantUpdating  $event
     * @return void
     */
    public function handle(ApplicantUpdating $event)
    {
        // Assign BDM on every MA was assigned
        if ($event->applicant->wasChanged('assign_ma_id')) {
            $event->applicant->assign_bdm_id = User::where('id', $event->applicant->getChanges()['assign_ma_id'])->first()->user_id;
        }
    }
}
