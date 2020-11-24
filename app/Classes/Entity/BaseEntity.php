<?php

namespace App\Classes\Entity;

use App\Applicant;
use Carbon\Carbon;

class BaseEntity implements BaseEntityInterface
{
    public ?string $filename = null;
    protected string $agent_id;
    protected string $producer_type = 'Agency-Agent';
    protected string $effective_date;
    protected string $appointed_date;
    protected ?string $date_expiry = '22000101';

    /**
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string|null $filename
     */
    public function setFilename(?string $filename): void
    {
        $this->filename = $filename;
    }

    /**
     * @return string
     */
    public function getAgentId(): string
    {
        return $this->agent_id;
    }

    /**
     * @param Applicant $applicant
     */
    public function setAgentId(Applicant $applicant): void
    {
        $this->agent_id = $applicant->agent_code;
    }

    /**
     * @return string
     */
    public function getEffectiveDate(): string
    {
        return $this->effective_date;
    }

    /**
     * @param Applicant $applicant
     */
    public function setEffectiveDate(Applicant $applicant): void
    {
        $this->effective_date = $applicant->getEffectiveDate()->format(config('constants.entity.date_format'));
    }

    /**
     * @return string
     */
    public function getAppointedDate(): string
    {
        return $this->appointed_date;
    }

    /**
     * @param Applicant $applicant
     */
    public function setAppointedDate(Applicant $applicant): void
    {
        $this->appointed_date = $applicant->getEffectiveDate()->format(config('constants.entity.date_format'));
    }

    public function generateFileName(string $entityType): void
    {
        $datetime = Carbon::now()->format('yymd_Hm');
        $filetype = 'txt';
        $this->filename = "cust_{$entityType}_{$this->getEntityEnvironment()}_{$datetime}_PMLI.{$filetype}";
    }

    protected function getEntityEnvironment()
    {
        if (env('APP_ENV') === 'production') {
            return 'PROD';
        }
        return 'DEV';
    }
}
