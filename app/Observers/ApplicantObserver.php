<?php

namespace App\Observers;

use App\Applicant;
use App\User;
use Illuminate\Support\Str;

class ApplicantObserver
{
    /**
     * Handle the applicant "creating" event.
     */
    public function creating(Applicant $applicant)
    {
        $utm_source = Str::lower($applicant->utm_source);

        // Get user to Assign
        $user = User::where('utm_source', $utm_source)->first();

        if ($user->is_admin) {
            $applicant->assign_admin_id = $user->id;
        }

        if ($user->is_bdm) {
            $applicant->assign_bdm_id = $user->id;
        }

        if ($user->is_ma) {
            $applicant->assign_ma_id = $user->id;
        }

        if ($user->is_staff) {
            $applicant->assign_staff_id = $user->id;
        }
    }

    /**
     * Handle the applicant "updated" event.
     */
    public function updated(Applicant $applicant)
    {
    }

    /**
     * Handle the applicant "deleted" event.
     */
    public function deleted(Applicant $applicant)
    {
    }

    /**
     * Handle the applicant "restored" event.
     */
    public function restored(Applicant $applicant)
    {
    }

    /**
     * Handle the applicant "force deleted" event.
     */
    public function forceDeleted(Applicant $applicant)
    {
    }
}
