<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendWebinarNotification extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param mixed $applicant
     */
    public function __construct($applicant)
    {
        $this->applicant = $applicant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support@chatesat.com', 'ChateSat Team')
            ->subject('Invitation to Join Webinar')
            ->view('email.invitation')
            ->with([
                'name' => $this->applicant->name,
                'date' => $this->applicant->interview_schedule->date,
                'time' => $this->applicant->interview_schedule->time,
                'url' => $this->applicant->interview_schedule->url,
                'accept_url' => url('/applicant/accept/'.$this->applicant->id),
                'reject_url' => url('/applicant/reject/'.$this->applicant->id),
            ])
        ;
    }
}
