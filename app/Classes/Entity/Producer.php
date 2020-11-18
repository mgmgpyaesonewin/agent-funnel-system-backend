<?php

namespace App\Classes\Entity;

use App\Applicant;

class Producer
{
    private $applicant;
    protected $agent_id;
    protected $producer_type = 'Agency-Agent';
    protected $position_code = 'Standard';

    public function __construct(Applicant $applicant)
    {
        $this->applicant = $applicant;
    }

}
