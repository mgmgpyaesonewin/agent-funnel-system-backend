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

class GenerateContactEntity implements ShouldQueue
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
            $date_effective = $applicant->statuses()->first()->pivot->created_at->toDateString();
            $contact_type = 'Mailing';
            $address_1 = $applicant->address;
            $address_2 = null;
            $address_3 = null;
            $post_code = null;
            $state_code = null; // in stagging db
            $city = null;
            $country = null;
            $agentbranch_office = null;
            $branchagency_code = null;
            $region = null;
            $bank_region = null;
            $office_tel = $applicant->secondary_phone;
            $resident_tel = null;
            $hp_tel = $applicant->phone;
            $email = $applicant->email;
            $date_expiry = '01/01/2200';

            $content .= "{$agent_id}|{$date_effective}|{$contact_type}|{$address_1}|{$address_2}|{$address_3}|{$post_code}|{$state_code}|{$city}|{$country}|{$agentbranch_office}|{$branchagency_code}|{$region}|{$bank_region}|{$office_tel}|{$resident_tel}|{$hp_tel}|{$email}|{$date_expiry}";
        }

        Storage::disk('public')->put("agents_info/$filename", $content);
    }
}
