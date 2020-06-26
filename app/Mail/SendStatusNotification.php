<?php

namespace App\Mail;

use App\Status;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendStatusNotification extends Mailable
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
        $status_text = lcfirst(Status::where('id', $this->applicant->status_id)->first()->title);
        $notification_text = "We have looked over your application and your application is currently set to {$status_text} stage.";

        return $this->from('support@chatesat.com', 'ChateSat Team')
            ->subject('Application Approval Status')
            ->view('email.notification')
            ->with([
                'name' => $this->applicant->name,
                'notification_text' => $notification_text,
            ])
        ;
    }
}
