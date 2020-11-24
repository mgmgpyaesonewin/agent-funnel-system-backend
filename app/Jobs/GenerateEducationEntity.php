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

class GenerateEducationEntity implements ShouldQueue
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
        $filename = "cust_EDU_DEV_{$datetime}_PMLI.{$filetype}";

        $content = null;
        $applicants = Applicant::all();

        foreach ($applicants as $applicant) {
            $agent_id = $applicant->agent_code;
            $date_effective = $applicant->getEffectiveDate();
            $examination_category = 'NIIM';
            $examination_description = 'National Insurance Institute of Myanmar';
            $examination_status = 'A';
            $examination_date_effective = $applicant->getLicenseExamPassDate()->format(config('constants.entity.date_format'));
            $examination_date_expiry = null;
            $credits = null;
            $date_expiry = '22001010';

            $content .= "{$agent_id}{$date_effective}|{$examination_category}|{$examination_description}|{$examination_status}|{$examination_date_effective}|{$examination_date_expiry}|{$credits}|{$date_expiry}\n";
        }

        Storage::disk('public')->put("agents_info/$filename", $content);
    }
}
