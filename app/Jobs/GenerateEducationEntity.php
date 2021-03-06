<?php

namespace App\Jobs;

use App\Applicant;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
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
        $datetime = Carbon::now()->format('Ymd_His');
        $filetype = 'txt';
        $file_env = 'PROD';
        if (App::environment('local')) {
            $file_env = 'DEV';
        }
        $filename = "cust_EDU_{$file_env}_{$datetime}_PMLI.{$filetype}";

        $content = null;
        $applicants_ids = get_applicants_ids_to_generate();
        $applicants = Applicant::with('statuses')->whereIn('id', $applicants_ids)->get();

        foreach ($applicants as $applicant) {
            $agent_id = $applicant->agent_code;
            $date_effective = $applicant->getEffectiveDate()->format(config('constants.entity.date_format'));
            $examination_category = 'NIIM';
            $examination_description = 'Life Insurance Agent Qualification Certificate';
            $examination_status = 'A';
            $examination_date_effective = $applicant->getLicenseExamPassDate()->format(config('constants.entity.date_format'));
            $examination_date_expiry = null;
            $credits = null;
            $date_expiry = '22000101';

            $content .= "{$agent_id}|{$date_effective}|{$examination_category}|{$examination_description}|{$examination_status}|{$examination_date_effective}|{$examination_date_expiry}|{$credits}|{$date_expiry}\n";
        }

        Log::info("Generated File: {$filename}");
        Storage::disk('public')->put("agents/$filename", $content);
    }
}
