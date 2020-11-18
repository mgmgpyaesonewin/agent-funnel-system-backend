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
        $datetime = Carbon::now()->format('yymd_Hm');
        $filetype = 'txt';
        $filename = "cust_CONT_DEV_{$datetime}_PMLI.{$filetype}";

        $content = null;
        $applicants = Applicant::all();

        foreach ($applicants as $applicant) {
            $agent_id = $applicant->agent_code;
            $license_id = null;
            $licence_type = null;
            $license_staus = null;
            $registration_number = null;
            $effective_date = null;
            $license_expiry_date = null;
            $date_expiry = null;
            $invoice_number = null;

            $content .= "{$agent_id}|{$license_id}|{$licence_type}|{$license_staus}|{$registration_number}|{$effective_date}|{$license_expiry_date}|{$date_expiry}|{$invoice_number}";
        }

        Storage::disk('public')->put("agents_info/$filename", $content);
    }
}
