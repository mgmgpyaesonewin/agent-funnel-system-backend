<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InviteBOPSession
{
    use Dispatchable;
    use SerializesModels;

    public $applicant_id;
    public $session_id;

    /**
     * Create a new event instance.
     */
    public function __construct(int $applicant_id, int $session_id)
    {
        $this->applicant_id = $applicant_id;
        $this->session_id = $session_id;
    }
}
