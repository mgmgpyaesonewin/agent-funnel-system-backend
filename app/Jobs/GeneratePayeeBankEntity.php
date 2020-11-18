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
        $filename = "cust_EDU_DEV_{$datetime}_PMLI.{$filetype}";

        $content = null;
        $applicants = Applicant::all();

        foreach ($applicants as $applicant) {
            $agent_id = $applicant->agent_code;
            $dateeff = $applicant->statuses()->first()->pivot->created_at->toDateString();
            $dateexp = '01/01/2200';
            $name = $applicant->bank_account_name;
            $bankname = $applicant->banK_name;
            $bankaccount = $applicant->bank_account_no;
            $accounttype = null;
            $income_tax_number = null;
            $swift_code = $applicant->swift_code;
            $payee_ic_type = null;
            $payee_ic_value = null;
            $business_registration_number = null;
            $payeebanktype = null;

            $content .= "{$agent_id}|{$dateeff}|{$dateexp}|{$name}|{$bankname}|{$bankaccount}|{$accounttype}|{$income_tax_number}|{$swift_code}|{$payee_ic_type}|{$payee_ic_value}|{$business_registration_number}|{$payeebanktype}";
        }

        Storage::disk('public')->put("agents_info/$filename", $content);
    }
}
