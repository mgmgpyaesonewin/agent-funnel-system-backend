<?php

namespace App\Classes\Entity;

use App\Applicant;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ContractEntity extends BaseEntity
{
    private Collection $applicants;
    protected ?string $contract_id = null; // $applicant->agent_code;
    protected string $contract_type = 'PMLI_AD';
    protected ?string $contract_status = 'A';
    protected ?string $contract_manager_id = null;
    protected ?string $title = 'MM Agency- Agent';
    protected ?string $agreement_type = 'Agent Agreement';
    protected ?string $agreement_date = null;
    protected ?string $unit_code = null;
    protected string $delimiter = '|';

    /**
     * @return string|null
     */
    public function getContractId(): ?string
    {
        return $this->contract_id;
    }

    /**
     * @param string|null $contract_id
     */
    public function setContractId(?string $contract_id): void
    {
        $this->contract_id = $contract_id;
    }

    /**
     * @return string|null
     */
    public function getAgreementDate(): ?string
    {
        return $this->agreement_date;
    }

    /**
     * @param Applicant $applicant
     */
    public function setAgreementDate(Applicant $applicant): void
    {
        $this->agreement_date = $applicant->getContractSignedDate()->format(config('constants.entity.date_format'));
    }

    /**
     * ContractEntity constructor.
     * @param Collection $applicants
     */
    public function __construct(Collection $applicants)
    {
        $this->applicants = $applicants;
    }

    public function generateFile()
    {
        $content = null;
        foreach ($this->applicants as $applicant) {
            //Agent Id
            $this->setAgentId($applicant);
            $content .= "{$this->getAgentId()}{$this->delimiter}";

            //Contract Id
            $this->setAgentId($applicant);
            $content .= "{$this->getAgentId()}{$this->delimiter}";

            //Contract Type
            $content .= "{$this->contract_type}{$this->delimiter}";

            //Date Effective
            $this->setEffectiveDate($applicant);
            $content .= "{$this->getEffectiveDate()}{$this->delimiter}";

            //Contract Status
            $content .= "{$this->contract_status}{$this->delimiter}";

            //Contract Manager Id
            $content .= "{$this->contract_manager_id}{$this->delimiter}";

            //Title
            $content .= "{$this->title}{$this->delimiter}";

            //Date Expiry
            $content .= "{$this->date_expiry}{$this->delimiter}";

            //Agreement Type
            $content .= "{$this->agreement_type}{$this->delimiter}";

            //Agreement Date
            $this->setAgreementDate($applicant);
            $content .= "{$this->getAgreementDate()}{$this->delimiter}";

            //Unit Code
            $content .= "{$this->unit_code}";

            // end of Line
            $content .= "\n";
        }

        Log::info("Generated File: {$this->getFilename()}");
        Storage::disk('public')->put("agents/{$this->getFilename()}", $content);
    }
}
