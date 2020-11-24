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

class GeneratePayeeBankEntity implements ShouldQueue
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
        $filename = "cust_BANK_DEV_{$datetime}_PMLI.{$filetype}";

        $content = null;
        $applicants = Applicant::all();

        foreach ($applicants as $applicant) {
            $agent_id = $applicant->agent_code;
            $dateeff = $applicant->getEffectiveDate()->format(config('constants.entity.date_format'));
            $dateexp = '22000101';
            $name = $applicant->bank_account_name;
            $bankname = 'MM-CB';
            $bankaccount = $applicant->bank_account_no;
            $accounttype = null;
            $income_tax_number = null;
            $swift_code = 'CPOBMMMY';
            $payee_ic_type = null;
            $payee_ic_value = $applicant->nrc;
            $business_registration_number = null;
            $payeebanktype = 'Personal';

            $content .= "{$agent_id}|{$dateeff}|{$dateexp}|{$name}|{$bankname}|{$bankaccount}|{$accounttype}|{$income_tax_number}|{$swift_code}|{$payee_ic_type}|{$payee_ic_value}|{$business_registration_number}|{$payeebanktype}\n";
        }

        Storage::disk('public')->put("agents_info/$filename", $content);
    }
}
