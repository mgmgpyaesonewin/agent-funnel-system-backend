<?php

namespace App\Listeners;

use App\Events\ApplicantUpdating;

class SendViberNotification
{
    protected $text;

    /**
     * Create the event listener.
     *
     * @param mixed $text
     */
    public function __construct($text)
    {
        $this->text = $text;
    }

    /**
     * Handle the event.
     */
    public function handle(ApplicantUpdating $event)
    {
        notified_applicant_via_viber($this->text);
    }
}
