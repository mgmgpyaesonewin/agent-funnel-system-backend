<?php

namespace App\Classes\Entity;

use App\Applicant;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdditionalInformationEntity extends BaseEntity
{
    private Collection $applicants;
    protected int $position_code = 25;
    protected ?string $old_ic_no = null;
    protected ?string $previous_code = null;
    protected ?string $agent_code;
    protected ?string $previous_company;
    protected ?string $previous_company_cessation_date;
    protected ?string $financing_version = null;
    protected ?string $bsc_eligibility_indicator = null;
    protected ?string $financing_batch_no = null;
    protected ?string $rejoin_agent = null;
    protected ?string $exception_reason = null;
    protected ?string $job_category_code = null;
    protected ?string $job_category = null;
    protected ?string $bsc_agent_category = null;
    protected ?string $termination_letter_date = null;
    protected ?string $dummy_indicator = null;
    protected ?string $financing_scheme = null;
    protected ?string $financing_category = null;
    protected ?string $fs_withdrawal_reason = null;
    protected ?string $related_agent_id = null;
    protected ?string $financing_scheme_status = null;
    protected ?string $outstanding_debt_collected_on_termination = null;
    protected ?string $fs_effective_start_date = null;
    protected ?string $ncb_achievement_date = null;
    protected ?string $fs_withdrawal_date = null;
    protected ?string $termination_effective_date = null;
    protected ?string $ncb_met_date = null;
    protected ?string $auto_withdrawal_flag = null;
    protected ?string $fs_downgrade_date = null;
    protected ?string $pamb_agreement_type = null;
    protected ?string $pbtb_agreement_type = null;
    protected ?string $finance_scheme_agreement_type = null;
    protected ?string $alc_agreement_type = null;
    protected ?string $pamb_agreement_date = null;
    protected ?string $pbtb_agreement_date = null;
    protected ?string $finance_scheme_agreement_date = null;
    protected ?string $alc_agreement_date = null;
    protected ?string $mta_license_exemption_attribute = null;
    protected ?string $related_insurance_advisor_id = null;
    protected ?string $company_registration_no = null;
    protected ?string $companys_name = null;
    protected ?string $issued_share_capital = null;
    protected ?string $incorporation_date = null;
    protected ?string $application_date = null;
    protected ?string $alc_status = null;
    protected ?string $alc_termination_date = null;
    protected ?string $alc_reinstatement_date = null;
    protected ?string $alc_applicant_self_declaration = null;
    protected ?string $alc_declaration_comments = null;
    protected ?string $bonus_rgb_statement_indicator = null;
    protected ?string $bonus_rgb_statement_date = null;
    protected ?string $rgb_payout_indicator = null;
    protected ?string $preferred_language = null;
    protected ?string $eae_e_assignment_exceptional_indicator = null;
    protected ?string $alc_related_agent_id = null;
    protected ?string $alc_effective_start_date = null;
    protected ?string $ql_recovery_letter_date = null;
    protected ?string $financing_outstanding_amount = null;
    protected string $delimeter = '|';

    /**
     * AdditionalInformationEntity constructor.
     * @param Collection $applicants
     */
    public function __construct(Collection $applicants)
    {
        $this->applicants = $applicants;
    }

    /**p
     * @return string
     */
    public function getAgentCode(): string
    {
        return $this->agent_code;
    }

    /**
     * @param Applicant $applicant
     */
    public function setAgentCode(Applicant $applicant): void
    {
        $this->agent_code = $applicant->temp_id;
    }

    /**
     * @return string|null
     */
    public function getPreviousCompany(): ?string
    {
        return $this->previous_company;
    }

    public function setPreviousCompany(): void
    {
        $this->previous_company = null;
    }

    /**
     * @return string|null
     */
    public function getPreviousCompanyCessationDate(): ?string
    {
        return $this->previous_company_cessation_date;
    }

    /**
     * @param Applicant $applicant
     */
    public function setPreviousCompanyCessationDate(Applicant $applicant): void
    {
        if ($applicant->getPreviousCompanyData()) {
            $this->previous_company_cessation_date = Carbon::parse($applicant->getPreviousCompanyData()->duration_to_date)->format(config('constants.entity.date_format'));
        } else {
            $this->previous_company_cessation_date = null;
        }
    }

    /**
     * @return string|null
     */
    public function getPambAgreementDate(): ?string
    {
        return $this->pamb_agreement_date;
    }

    /**
     * @param Applicant $applicant
     */
    public function setPambAgreementDate(Applicant $applicant): void
    {
        $this->pamb_agreement_date = $applicant->getContractSignedDate()->format(config('constants.entity.date_format'));
    }

    public function generateFile()
    {
        $content = null;
        foreach ($this->applicants as $applicant) {
            $this->setAgentId($applicant);
            $content .= "{$this->getAgentId()}{$this->delimeter}";

            $content .= "{$this->producer_type}{$this->delimeter}";

            $content .= "{$this->previous_code}{$this->delimeter}";

            $content .= "{$this->old_ic_no}{$this->delimeter}";

            $this->setEffectiveDate($applicant);
            $content .= "{$this->getEffectiveDate()}{$this->delimeter}";

            //Agent Code
            $this->setAgentCode($applicant);
            $content .= "{$this->getAgentCode()}{$this->delimeter}";

            //Previous Company
            $this->setPreviousCompany($applicant);
            $content .= "{$this->getPreviousCompany()}{$this->delimeter}";

            //Previous Company Cessation Date
            $this->setPreviousCompanyCessationDate($applicant);
            $content .= "{$this->getPreviousCompanyCessationDate()}{$this->delimeter}";

            //Financing Version
            $content .= "{$this->financing_version}{$this->delimeter}";

            //BSC Eligibility Indicator
            $content .= "{$this->bsc_eligibility_indicator}{$this->delimeter}";

            //Financing Batch No
            $content .= "{$this->financing_batch_no}{$this->delimeter}";

            //Rejoin Agent
            $content .= "{$this->rejoin_agent}{$this->delimeter}";

            //Exception Reason
            $content .= "{$this->exception_reason}{$this->delimeter}";

            //Job Category Code
            $content .= "{$this->job_category_code}{$this->delimeter}";

            //Job Category
            $content .= "{$this->job_category}{$this->delimeter}";

            //BSC Agent Category
            $content .= "{$this->bsc_agent_category}{$this->delimeter}";

            //Date Expiry
            $content .= "{$this->date_expiry}{$this->delimeter}";

            //Termination Letter Date
            $content .= "{$this->termination_letter_date}{$this->delimeter}";

            //Dummy Indicator
            $content .= "{$this->dummy_indicator}{$this->delimeter}";

            //Financing Scheme
            $content .= "{$this->financing_scheme}{$this->delimeter}";

            //Financing Category
            $content .= "{$this->financing_category}{$this->delimeter}";

            //FS Withdrawal Reason
            $content .= "{$this->fs_withdrawal_reason}{$this->delimeter}";

            //Related Agent Id
            $content .= "{$this->related_agent_id}{$this->delimeter}";

            //Financing Scheme Status
            $content .= "{$this->financing_scheme_status}{$this->delimeter}";

            //Outstanding Debt Collected On Termination
            $content .= "{$this->outstanding_debt_collected_on_termination}{$this->delimeter}";

            //FS Effective Start Date
            $content .= "{$this->fs_effective_start_date}{$this->delimeter}";

            //NCB Achievement Date
            $content .= "{$this->ncb_achievement_date}{$this->delimeter}";

            //FS Withdrawal Date
            $content .= "{$this->fs_withdrawal_date}{$this->delimeter}";

            //Termination Effective Date
            $content .= "{$this->termination_effective_date}{$this->delimeter}";

            //NCB Met Date
            $content .= "{$this->ncb_met_date}{$this->delimeter}";

            //Auto Withdrawal Flag
            $content .= "{$this->auto_withdrawal_flag}{$this->delimeter}";

            //FS Downgrade Date
            $content .= "{$this->fs_downgrade_date}{$this->delimeter}";

            //PAMB Agreement Type
            $content .= "{$this->pamb_agreement_type}{$this->delimeter}";

            //PBTB Agreement Type
            $content .= "{$this->pamb_agreement_type}{$this->delimeter}";

            //Finance Scheme Agreement Type
            $content .= "{$this->finance_scheme_agreement_type}{$this->delimeter}";

            //ALC Agreement Type
            $content .= "{$this->alc_agreement_type}{$this->delimeter}";

            //PAMB Agreement Date
            $this->setPambAgreementDate($applicant);
            $content .= "{$this->getPambAgreementDate()}{$this->delimeter}";

            //PBTB Agreement Date
            $content .= "{$this->pbtb_agreement_date}{$this->delimeter}";

            //Finance Scheme Agreement Date
            $content .= "{$this->finance_scheme_agreement_date}{$this->delimeter}";

            //ALC Agreement Date
            $content .= "{$this->alc_agreement_date}{$this->delimeter}";

            //MTA License Exemption Attribute
            $content .= "{$this->mta_license_exemption_attribute}{$this->delimeter}";

            //Related Insurance Advisor ID
            $content .= "{$this->related_insurance_advisor_id}{$this->delimeter}";

            //Company Registration No
            $content .= "{$this->company_registration_no}{$this->delimeter}";

            //Company's Name:
            $content .= "{$this->companys_name}{$this->delimeter}";

            //Issued Share Capital
            $content .= "{$this->issued_share_capital}{$this->delimeter}";

            //Incorporation Date
            $content .= "{$this->incorporation_date}{$this->delimeter}";

            //Application Date
            $content .= "{$this->application_date}{$this->delimeter}";

            //ALC Status
            $content .= "{$this->alc_status}{$this->delimeter}";

            //ALC Termination Date
            $content .= "{$this->alc_termination_date}{$this->delimeter}";

            //ALC Reinstatement Date
            $content .= "{$this->alc_reinstatement_date}{$this->delimeter}";

            //ALC Applicant Self Declaration
            $content .= "{$this->alc_applicant_self_declaration}{$this->delimeter}";

            //ALC Declaration Comments
            $content .= "{$this->alc_declaration_comments}{$this->delimeter}";

            //Bonus RGB Statement Indicator
            $content .= "{$this->bonus_rgb_statement_indicator}{$this->delimeter}";

            //Bonus RGB Statement Date
            $content .= "{$this->bonus_rgb_statement_date}{$this->delimeter}";

            //RGB Payout Indicator
            $content .= "{$this->rgb_payout_indicator}{$this->delimeter}";

            //Preferred Language
            $content .= "{$this->preferred_language}{$this->delimeter}";

            //EAE [E-assignment Exceptional] Indicator
            $content .= "{$this->eae_e_assignment_exceptional_indicator}{$this->delimeter}";

            //ALC Related Agent ID
            $content .= "{$this->alc_related_agent_id}{$this->delimeter}";

            //ALC Effective Start Date
            $content .= "{$this->alc_effective_start_date}{$this->delimeter}";

            //QL Recovery Letter Date
            $content .= "{$this->ql_recovery_letter_date}{$this->delimeter}";

            //Financing Outstanding Amount
            $content .= "{$this->financing_outstanding_amount}{$this->delimeter}";

            // end of Line
            $content .= "\n";
        }
        Log::info("Generated File: {$this->getFilename()}");
        Storage::disk('public')->put("agents/{$this->getFilename()}", $content);
    }
}
