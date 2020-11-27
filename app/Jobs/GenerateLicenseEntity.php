<?php

namespace App\Jobs;

use App\Applicant;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class GenerateLicenseEntity implements ShouldQueue
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
        $datetime = Carbon::now()->format('yymd_His');
        $filetype = 'txt';
        $filename = "cust_LICN_DEV_{$datetime}_PMLI.{$filetype}";

        $content = null;
        $applicants_ids = Applicant::withActivatedWithinInterval()->pluck('applicants.id')->toArray();
        $applicants = Applicant::with('statuses')->whereIn('id', $applicants_ids)->get();

        foreach ($applicants as $applicant) {
            $agent_id = $applicant->agent_code;
            $license_id = null;
            $licence_type = 'Life';
            $license_staus = 'A';
            $registration_number = $applicant->license_no;
            $effective_date = $applicant->getEffectiveDate()->format(config('constants.entity.date_format'));
            $license_expiry_date = null;
            $date_expiry = '22000101';
            $invoice_number = null;

            $content .= "{$agent_id}|{$license_id}|{$licence_type}|{$license_staus}|{$registration_number}|{$effective_date}|{$license_expiry_date}|{$date_expiry}|{$invoice_number}\n";
        }

        Log::info("Generated File: {$filename}");
        Storage::disk('public')->put("agents/$filename", $content);
    }
}
