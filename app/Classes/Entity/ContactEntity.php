<?php

namespace App\Classes\Entity;

use App\Applicant;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ContactEntity extends BaseEntity
{
    private Collection $applicants;
    protected string $contact_type = 'Mailing';
    protected ?string $address_1 = null; //$applicant->address;
    protected ?string $address_2 = null;
    protected ?string $address_3 = null;
    protected ?string $post_code = null;
    protected ?string $state_code = null; // in stagging db
    protected ?string $city = null;
    protected ?string $country = 'MYANMAR';
    protected ?string $agentbranch_office = null;
    protected ?string $branchagency_code = null;
    protected ?string $region = null;
    protected ?string $bank_region = null;
    protected ?string $office_tel = null;
    protected ?string $resident_tel = null;
    protected ?string $hp_tel = null;
    protected ?string $email = null;
    protected string $delimiter = '|';

    /**
     * ContactEntity constructor.
     * @param Collection $applicants
     */
    public function __construct(Collection $applicants)
    {
        $this->applicants = $applicants;
    }

    /**
     * @return string|null
     */
    public function getAddress1(): ?string
    {
        return $this->address_1;
    }

    /**
     * @param Applicant $applicant
     */
    public function setAddress1(Applicant $applicant): void
    {
        $this->address_1 = preg_replace('~[\r\n]+~', '', $applicant->address);
    }

    /**
     * @return string|null
     */
    public function getStateCode(): ?string
    {
        return $this->state_code;
    }

    /**
     * @param Applicant $applicant
     */
    public function setStateCode(Applicant $applicant): void
    {
        $this->state_code = $applicant->getStateCode();
    }

    /**
     * @return string|null
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @param Applicant $applicant
     */
    public function setRegion(Applicant $applicant): void
    {
        $this->region = $region;
    }

    /**
     * @return string|null
     */
    public function getOfficeTel(): ?string
    {
        return $this->office_tel;
    }

    /**
     * @param Applicant $applicant
     */
    public function setOfficeTel(Applicant $applicant): void
    {
        $this->office_tel = $applicant->secondary_phone;
    }

    /**
     * @return string|null
     */
    public function getHpTel(): ?string
    {
        return $this->hp_tel;
    }

    /**
     * @param Applicant $applicant
     */
    public function setHpTel(Applicant $applicant): void
    {
        $this->hp_tel = $applicant->phone;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param Applicant $applicant
     */
    public function setEmail(Applicant $applicant): void
    {
        $this->email = $applicant->email;
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

            //Contact Type
            $content .= "{$this->contact_type}{$this->delimiter}";

            //Address 1
            $this->setAddress1($applicant);
            $content .= "{$this->getAddress1()}{$this->delimiter}";

            //Address 2
            $content .= "{$this->address_2}{$this->delimiter}";

            //Address 3
            $content .= "{$this->address_3}{$this->delimiter}";

            //Post Code
            $content .= "{$this->post_code}{$this->delimiter}";

            //State Code
            $this->setStateCode($applicant);
            $content .= "{$this->getStateCode()}{$this->delimiter}";

            //City
            $content .= "{$this->city}{$this->delimiter}";

            //Country
            $content .= "{$this->country}{$this->delimiter}";

            //Agent/Branch Office
            $content .= "{$this->agentbranch_office}{$this->delimiter}";

            //Branch/Agency Code
            $content .= "{$this->branchagency_code}{$this->delimiter}";

            //Region
            $content .= "{$this->getStateCode()}{$this->delimiter}";

            //Bank Region
            $content .= "{$this->bank_region}{$this->delimiter}";

            //Office Tel.
            $this->setOfficeTel($applicant);
            $content .= "{$this->getOfficeTel()}{$this->delimiter}";

            //Resident Tel.
            $content .= "{$this->resident_tel}{$this->delimiter}";

            //H/P Tel.
            $this->setHpTel($applicant);
            $content .= "{$this->getHpTel()}{$this->delimiter}";

            //Email
            $this->setEmail($applicant);
            $content .= "{$this->getEmail()}{$this->delimiter}";

            //Date Expiry
            $content .= "{$this->date_expiry}{$this->delimiter}";

            // end of Line
            $content .= "\n";
        }
        Log::info("Generated File: {$this->getFilename()}");
        Storage::disk('public')->put("agents/{$this->getFilename()}", $content);
    }
}
