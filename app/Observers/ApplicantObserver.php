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
        $user = User::whereNull('partner_id')->where('utm_source', $utm_source)->first();

        if (!empty($user)) {
            if ($user->is_admin) {
                $applicant->assign_admin_id = $user->id;
            }

            if ($user->is_bdm) {
                $applicant->assign_bdm_id = $user->id;
            }

            if ($user->is_ma) {
                $applicant->assign_ma_id = $user->id;

                $bdm_user = User::where('id', $user->user_id)->first();
                $applicant->assign_bdm_id = $bdm_user->id;
            }

            if ($user->is_staff) {
                $applicant->assign_staff_id = $user->id;
            }
        }

        // Add partner
        $user = User::where('utm_source', $utm_source)->first();

        if (isset($user->partner_id)) {
            $applicant->partner_id = $user->partner_id;
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
