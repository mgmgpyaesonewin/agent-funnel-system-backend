<?php

namespace App\Jobs;

use App\Applicant;
use App\Contract;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class GenerateProducerAdditionalInformationEntity implements ShouldQueue
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
        $filename = "cust_ADD_INFO_DEV_{$datetime}_PMLI.{$filetype}";

        $content = null;
        $applicants = Applicant::all();

        foreach ($applicants as $applicant) {
            $agent_id = $applicant->agent_code;
            $producer_type = 'Agency-Agent';
            $old_ic_no = null;
            $previous_code = null;
            $effective_date = $applicant->statuses()->first()->pivot->created_at->toDateString();
            $agent_code = $applicant->temp_id;
            $previous_company = $applicant->employment;
            $previous_company_cessation_date = $applicant->employment->to;
            $financing_version = null;
            $bsc_eligibility_indicator = null;
            $financing_batch_no = null;
            $rejoin_agent = null;
            $exception_reason = null;
            $job_category_code = null;
            $job_category = null;
            $bsc_agent_category = null;
            $date_expiry = '01/01/2200';
            $ncb_met_date = null;
            $termination_letter_date = null;
            $dummy_indicator = null;
            $financing_scheme = null;
            $financing_category = null;
            $fs_withdrawal_reason = null;
            $related_agent_id = null;
            $financing_scheme_status = null;
            $outstanding_debt_collected_on_termination = null;
            $fs_effective_start_date = null;
            $ncb_achievement_date = null;
            $fs_withdrawal_date = null;
            $termination_effective_date = null;
            $ncb_met_date = null;
            $auto_withdrawal_flag = null;
            $fs_downgrade_date = null;
            $pamb_agreement_type = null;
            $pbtb_agreement_type = null;
            $finance_scheme_agreement_type = null;
            $alc_agreement_type = null;
            $pamb_agreement_date = Contract::first()->created_at;
            $pbtb_agreement_date = null;
            $finance_scheme_agreement_date = null;
            $alc_agreement_date = null;
            $mta_license_exemption_attribute = null;
            $related_insurance_advisor_id = null;
            $company_registration_no = null;
            $companys_name = null;
            $issued_share_capital = null;
            $incorporation_date = null;
            $application_date = null;
            $alc_status = null;
            $alc_termination_date = null;
            $alc_reinstatement_date = null;
            $alc_applicant_self_declaration = null;
            $alc_declaration_comments = null;
            $bonus_rgb_statement_indicator = null;
            $bonus_rgb_statement_date = null;
            $rgb_payout_indicator = null;
            $preferred_language = null;
            $eae_e_assignment_exceptional_indicator = null;
            $alc_related_agent_id = null;
            $alc_effective_start_date = null;
            $ql_recovery_letter_date = null;
            $financing_outstanding_amount = null;

            $content .= "{$agent_id}|{$producer_type}|{$old_ic_no}|{$previous_code}|{$effective_date}|{$agent_code}|{$previous_company}|{$previous_company_cessation_date}|{$financing_version}|{$bsc_eligibility_indicator}|{$financing_batch_no}|{$rejoin_agent}|{$exception_reason}|{$job_category_code}|{$job_category}|{$bsc_agent_category}|{$date_expiry}|{$termination_letter_date}|{$dummy_indicator}|{$financing_scheme}|{$financing_category}|{$fs_withdrawal_reason}|{$related_agent_id}|{$financing_scheme_status}|{$outstanding_debt_collected_on_termination}|{$fs_effective_start_date}|{$ncb_achievement_date}|{$fs_withdrawal_date}|{$termination_effective_date}|{$ncb_met_date}|{$auto_withdrawal_flag}|{$fs_downgrade_date}|{$pamb_agreement_type}|{$pbtb_agreement_type}|{$finance_scheme_agreement_type}|{$alc_agreement_type}|{$pamb_agreement_date}|{$pbtb_agreement_date}|{$finance_scheme_agreement_date}|{$alc_agreement_date}|{$mta_license_exemption_attribute}|{$related_insurance_advisor_id}|{$company_registration_no}|{$companys_name}|{$issued_share_capital}|{$incorporation_date}|{$application_date}|{$alc_status}|{$alc_termination_date}|{$alc_reinstatement_date}|{$alc_applicant_self_declaration}|{$alc_declaration_comments}|{$bonus_rgb_statement_indicator}|{$bonus_rgb_statement_date}|{$rgb_payout_indicator}|{$preferred_language}|{$eae_e_assignment_exceptional_indicator}|{$alc_related_agent_id}|{$alc_effective_start_date}|{$ql_recovery_letter_date}|{$financing_outstanding_amount}";
        }

        Storage::disk('public')->put("agents_info/$filename", $content);
    }
}
