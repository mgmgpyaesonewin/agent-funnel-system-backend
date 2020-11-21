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

class GenerateProducerEntity implements ShouldQueue
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
        $datetime = Carbon::now()->format('yymd_Hm');
        $filetype = 'txt';
        $filename = "cust_PROD_DEV_{$datetime}_PMLI.{$filetype}";

        $content = null;
        $applicants = Applicant::all();

        foreach ($applicants as $applicant) {
            $agent_id = $applicant->agent_code;
            $producer_type = 'Agency-Agent';
            $position_code = 'Standard';
            $new_ic_no = $applicant->nrc;
            $company_registration_no = null;
            $company_name = null;
            $preferred_name = $applicant->preferred_name;
            $name = $applicant->name;
            $dob = $applicant->dob;
            $effective_date = $applicant->getEffectiveDate();
            $appointed_date = $applicant->getEffectiveDate();
            $reinstmnt_date = null;
            $termination_date = null;
            $race = $applicant->race;
            $status = 'active';
            $class = null;
            $gender = $applicant->gender;
            $education_qualification = $applicant->education;
            $common_category = null;
            $citizenship = $applicant->getCitizenship();
            $marital_status = $applicant->married;
            $coporate_email = null;
            $gst_no = null;
            $gst_registered_agent = null;
            $gst_de_registration = null;
            $termination_type = null;
            $bank_staff_code = null;
            $company_authorized_capital = null;
            $company_paid_up_capital = null;
            $company_code = null;
            $comment = null;
            $date_expiry = '01/01/2200';
            $company_incorporation_date = null;

            $content .= "{$agent_id}|{$producer_type}|{$position_code}|{$new_ic_no}|{$company_registration_no}|{$company_name}|{$preferred_name}|{$name}|{$dob}|{$effective_date}|{$appointed_date}|{$reinstmnt_date}|{$termination_date}|{$race}|{$status}|{$class}|{$gender}|{$education_qualification}|{$common_category}|{$citizenship}|{$marital_status}|{$coporate_email}|{$gst_no}|{$gst_registered_agent}|{$gst_de_registration}|{$termination_type}|{$bank_staff_code}|{$company_authorized_capital}|{$company_paid_up_capital}|{$company_code}|{$comment}|{$date_expiry}|{$company_incorporation_date}\n";
        }

        Storage::disk('public')->put("agents_info/$filename", $content);
    }
}
