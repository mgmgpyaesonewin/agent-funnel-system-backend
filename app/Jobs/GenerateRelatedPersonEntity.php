<?php

namespace App\Jobs;

use App\Applicant;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class GenerateRelatedPersonEntity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $datetime = Carbon::now()->format('yymd_Hms');
        $filetype = 'txt';
        $filename = "cust_RLTP_DEV_{$datetime}_PMLI.{$filetype}";

        $content = null;
        $applicants = Applicant::all();

        foreach ($applicants as $applicant) {
            $agent_id = $applicant->agent_code;
            $entity_type = 'Spouse'; // If spouse details present
            $dateeff = $applicant->getEffectiveDate()->format(config('constants.entity.date_format'));
            $entity_name = $applicant->spouse_name;
            $entity_status = 'A';
            $entity_share_percent = null;
            $entity_succession_order = null;
            $entity_nric_new = $applicant->spouse_nrc;
            $entity_nric_old = null;
            $entity_relationship = 'Spouse';
            $entity_agent_id = null;
            $entity_contact_number = null;
            $entity_dob = null;
            $date_expiry = '22000101';
            $id_type = null;
            $id_number = null;
            $entity_no_of_shares_held = null;
            $is_director = null;

            $content .= "{$agent_id}|{$entity_type}|{$dateeff}|{$entity_name}|{$entity_status}|{$entity_share_percent}|{$entity_succession_order}|{$entity_nric_new}|{$entity_nric_old}|{$entity_relationship}|{$entity_agent_id}|{$entity_contact_number}|{$entity_dob}|{$date_expiry}|{$id_type}|{$id_number}|{$entity_no_of_shares_held}|{$is_director}\n";
        }

        Storage::disk('public')->put("agents_info/$filename", $content);
    }
}
