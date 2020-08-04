<?php

namespace App\Events;

use App\Applicant;
use Illuminate\Queue\SerializesModels;

class ApplicantUpdating
{
    use SerializesModels;

    public $applicant;

    /**
     * Create a new event instance.
     */
    public function __construct(Applicant $applicant)
    {
        $this->applicant = $applicant;
    }
}
