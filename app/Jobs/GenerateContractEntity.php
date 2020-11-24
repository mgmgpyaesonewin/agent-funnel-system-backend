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

class GenerateContractEntity implements ShouldQueue
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
            $contract_id = $applicant->agent_code;
            $contract_type = 'PMLI_AD';
            $date_effective = $applicant->getEffectiveDate();
            $contract_status = 'A';
            $contract_manager_id = null;
            $title = 'MM Agency-Agent';
            $date_expiry = '22000101';
            $agreement_type = 'Agent Agreement';
            $agreement_date = $applicant->getLicenseExamPassDate();
            $unit_code = null;

            $content .= "{$agent_id}|{$contract_id}|{$contract_type}|{$date_effective}|{$contract_status}|{$contract_manager_id}|{$title}|{$date_expiry}|{$agreement_type}|{$agreement_date}|{$unit_code}\n";
        }

        Storage::disk('public')->put("agents_info/$filename", $content);
    }
}
