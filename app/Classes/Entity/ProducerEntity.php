<?php

namespace App\Classes\Entity;

use App\Applicant;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProducerEntity extends BaseEntity
{
    private Collection $applicants;
    protected int $position_code = 25;
    protected string $new_ic_no;
    protected ?string $company_registration_no = null;
    protected ?string $company_name = null;
    protected ?string $preferred_name;
    protected string $name;
    protected string $dob;
    protected ?string $reinstmnt_date = null;
    protected ?string $termination_date = null;
    protected ?string $race;
    protected string $status = 'A';
    protected ?string $class = null;
    protected string $gender;
    protected ?string $education_qualification;
    protected ?string $common_category = null;
    protected ?string $citizenship;
    protected ?string $marital_status = null;
    protected ?string $corporate_email = null;
    protected ?string $gst_no = null;
    protected ?string $gst_registered_agent = null;
    protected ?string $gst_registration_date = null;
    protected ?string $gst_de_registration = null;
    protected ?string $termination_type = null;
    protected ?string $bank_staff_code = null;
    protected ?string $company_authorized_capital = null;
    protected ?string $company_paid_up_capital = null;
    protected ?string $company_code = null;
    protected ?string $comment = null;
    protected ?string $company_incorporation_date = null;

    /**
     * ProducerEntity constructor.
     * @param Collection $applicants
     */
    public function __construct(Collection $applicants)
    {
        $this->applicants = $applicants;
    }

    /**
     * @return string
     */
    public function getNewIcNo(): string
    {
        return $this->new_ic_no;
    }

    /**
     * @param Applicant $applicant
     */
    public function setNewIcNo(Applicant $applicant): void
    {
        $this->new_ic_no = $applicant->nrc;
    }

    public function getPreferredName()
    {
        return $this->preferred_name;
    }

    /**
     * @param Applicant $applicant
     */
    public function setPreferredName(Applicant $applicant): void
    {
        $this->preferred_name = $applicant->preferred_name;
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
     * @return string
     */
    public function getDob(): string
    {
        return $this->dob;
    }

    /**
     * @param Applicant $applicant
     */
    public function setDob(Applicant $applicant): void
    {
        $this->dob = Carbon::parse($applicant->dob)->format('Ymd');
    }

    /**
     * @return string
     */
    public function getRace(): string
    {
        return $this->race;
    }

    /**
     * @param Applicant $applicant
     */
    public function setRace(Applicant $applicant): void
    {
        if ($applicant->race == 'Burma') {
            $this->race = 'B';
        } else {
            $this->race = 'O';
        }
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param Applicant $applicant
     */
    public function setGender(Applicant $applicant): void
    {
        if ($applicant->gender === 'Male') {
            $this->gender = 'M';
        } else {
            $this->gender = 'F';
        }
    }

    /**
     * @return string
     */
    public function getEducationQualification()
    {
        return $this->education_qualification;
    }

    /**
     * @param Applicant $applicant
     */
    public function setEducationQualification(Applicant $applicant): void
    {
        switch ($applicant->education) {
            case 'Diploma or equivalent': $this->education_qualification = 'DP'; break;
            case 'Graduate': $this->education_qualification = 'GD'; break;
            case 'Post Graduate': $this->education_qualification = 'PG'; break;
            case 'Primary Education': $this->education_qualification = 'PR'; break;
            case 'Secondary Education': $this->education_qualification = 'S'; break;
            case 'Matriculation': $this->education_qualification = 'H'; break;
            default: $this->education_qualification = null;
        }
    }

    /**
     * @return string
     */
    public function getCitizenship(): string
    {
        return $this->citizenship;
    }

    /**
     * @param Applicant $applicant
     */
    public function setCitizenship(Applicant $applicant): void
    {
        if ($applicant->getCitizenship() == 'Myanmar') {
            $this->citizenship = 'MM';
        } else {
            $this->citizenship = 'N';
        }
    }

    /**
     * @return string
     */
    public function getMaritalStatus(): string
    {
        return $this->marital_status;
    }

    /**
     * @param Applicant $applicant
     */
    public function setMaritalStatus(Applicant $applicant): void
    {
        switch ($applicant->married) {
            case 'Divorced': $this->marital_status = 'D'; break;
            case 'Married': $this->marital_status = 'M'; break;
            case 'Single': $this->marital_status = 'S'; break;
            case 'Widowed': $this->marital_status = 'W'; break;
            default: $this->marital_status = null;
        }
    }

    public function generateFile()
    {
        $content = null;
        foreach ($this->applicants as $applicant) {
            $this->setAgentId($applicant);
            Log::info("Agent with {$this->getAgentId()} generated");
            $this->setNewIcNo($applicant);
            $this->setPreferredName($applicant);
            $this->setName($applicant);
            $this->setDob($applicant);
            $this->setEffectiveDate($applicant);
            $this->setAppointedDate($applicant);
            $this->setRace($applicant);
            $this->setGender($applicant);
            $this->setEducationQualification($applicant);
            $this->setCitizenship($applicant);
            $this->setMaritalStatus($applicant);

            $content .= "{$this->getAgentId()}|{$this->producer_type}|{$this->position_code}|{$this->getNewIcNo()}|{$this->company_registration_no}|{$this->company_name}|{$this->getPreferredName()}|{$this->getName()}|{$this->getDob()}|{$this->getEffectiveDate()}|{$this->getAppointedDate()}|{$this->reinstmnt_date}|{$this->termination_date}|{$this->getRace()}|{$this->status}|{$this->class}|{$this->getGender()}|{$this->getEducationQualification()}|{$this->common_category}|{$this->getCitizenship()}|{$this->getMaritalStatus()}|{$this->corporate_email}|{$this->gst_no}|{$this->gst_registered_agent}|{$this->gst_registration_date}|{$this->gst_de_registration}|{$this->termination_type}|{$this->bank_staff_code}|{$this->company_authorized_capital}|{$this->company_paid_up_capital}|{$this->company_code}|{$this->comment}|{$this->date_expiry}|{$this->company_incorporation_date}\n";
        }

        Log::info("Generated File: {$this->getFilename()}");
        Storage::disk('public')->put("agents/{$this->getFilename()}", $content);
    }
}
