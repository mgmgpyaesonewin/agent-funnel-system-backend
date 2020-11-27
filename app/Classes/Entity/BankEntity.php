<?php

namespace App\Classes\Entity;

use App\Applicant;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BankEntity extends BaseEntity
{
    private Collection $applicants;
    protected ?string $name = null;
    protected ?string $bankname = null;
    protected ?string $bankaccount = null;
    protected ?string $accounttype = null;
    protected ?string $income_tax_number = null;
    protected ?string $swift_code = null; // 'CPOBMMMY';
    protected ?string $payee_ic_type = 'New IC Number';
    protected ?string $payee_ic_value = null; // $applicant->nrc;
    protected ?string $business_registration_number = null;
    protected ?string $payeebanktype = 'Personal';
    protected string $delimiter = '|';

    /**
     * BankEntity constructor.
     * @param Collection $applicants
     */
    public function __construct(Collection $applicants)
    {
        $this->applicants = $applicants;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param Applicant $applicant
     */
    public function setName(Applicant $applicant): void
    {
        $this->name = $applicant->name;
    }

    /**
     * @return string|null
     */
    public function getBankname(): ?string
    {
        return $this->bankname;
    }

    /**
     * @param Applicant $applicant
     */
    public function setBankname(Applicant $applicant): void
    {
        switch ($applicant->banK_name) {
            case 'YOMA BANK': $this->bankname = 'MM-YOMA'; break;
            case 'AYEYARWADY BANK (AYA BANK)': $this->bankname = 'MM-AYA'; break;
            case 'KANBAWZA BANK (KBZ BANK)': $this->bankname = 'MM-KBZ'; break;
            case 'CO-OPERATIVE BANK (CB BANK)': $this->bankname = 'MM-CB'; break;
            case 'AYEYARWADDY FARMERS DEVELOPMENT BANK (A BANK)': $this->bankname = 'MM-AFD'; break;
            case 'MYANMAR APEX BANK': $this->bankname = 'MM-MAB'; break;
            case 'ASIA GREEN DEVELOPMENT BANK (AGD BANK)': $this->bankname = 'MM-AGD'; break;
            case 'UNITED AMARA BANK (UAB BANK)': $this->bankname = 'MM-UAB'; break;
            case 'INNWA BANK': $this->bankname = 'MM-INW'; break;
            case 'MYAWADDY BANK': $this->bankname = 'MM-MYD'; break;
            default: $this->bankname = null;
        }
    }

    /**
     * @return string|null
     */
    public function getBankaccount(): ?string
    {
        return $this->bankaccount;
    }

    /**
     * @param Applicant $applicant
     */
    public function setBankaccount(Applicant $applicant): void
    {
        $this->bankaccount = $applicant->bank_account_no;
    }

    /**
     * @return string|null
     */
    public function getSwiftCode(): ?string
    {
        return $this->swift_code;
    }

    /**
     * @param Applicant $applicant
     */
    public function setSwiftCode(Applicant $applicant): void
    {
        $this->swift_code = $applicant->swift_code;
    }

    /**
     * @return string|null
     */
    public function getPayeeIcValue(): ?string
    {
        return $this->payee_ic_value;
    }

    /**
     * @param Applicant $applicant
     */
    public function setPayeeIcValue(Applicant $applicant): void
    {
        $this->payee_ic_value = $applicant->nrc;
    }

    /**
     * @return string|null
     */
    public function getBusinessRegistrationNumber(): ?string
    {
        return $this->business_registration_number;
    }

    /**
     * @param string|null $business_registration_number
     */
    public function setBusinessRegistrationNumber(?string $business_registration_number): void
    {
        $this->business_registration_number = $business_registration_number;
    }

    /**
     * @return string|null
     */
    public function getPayeebanktype(): ?string
    {
        return $this->payeebanktype;
    }

    /**
     * @param string|null $payeebanktype
     */
    public function setPayeebanktype(?string $payeebanktype): void
    {
        $this->payeebanktype = $payeebanktype;
    }

    public function generateFile()
    {
        $content = null;
        foreach ($this->applicants as $applicant) {
            // Agent Id
            $this->setAgentId($applicant);
            $content .= "{$this->getAgentId()}{$this->delimiter}";

            //Date Effective
            $this->setEffectiveDate($applicant);
            $content .= "{$this->getEffectiveDate()}{$this->delimiter}";

            //Date Expiry
            $content .= "{$this->date_expiry}{$this->delimiter}";

            //Name
            $this->setName($applicant);
            $content .= "{$this->getName()}{$this->delimiter}";

            //BankName
            $this->setBankname($applicant);
            $content .= "{$this->getBankname()}{$this->delimiter}";

            //BankAccount
            $this->setBankaccount($applicant);
            $content .= "{$this->getBankaccount()}{$this->delimiter}";

            //AccountType
            $content .= "{$this->accounttype}{$this->delimiter}";

            //Income Tax Number
            $content .= "{$this->income_tax_number}{$this->delimiter}";

            //Swift Code
            $this->setSwiftCode($applicant);
            $content .= "{$this->getSwiftCode()}{$this->delimiter}";

            //Payee IC Type
            $content .= "{$this->payee_ic_type}{$this->delimiter}";

            //Payee IC Value
            $this->setPayeeIcValue($applicant);
            $content .= "{$this->getPayeeIcValue()}{$this->delimiter}";

            //Business Registration Number
            $content .= "{$this->business_registration_number}{$this->delimiter}";

            //PayeeBankType
            $content .= "{$this->payeebanktype}";

            // end of Line
            $content .= "\n";
        }
        Log::info("Generated File: {$this->getFilename()}");
        Storage::disk('public')->put("agents/{$this->getFilename()}", $content);
    }
}
