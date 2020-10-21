<?php

namespace App\Listeners;

use App\Applicant;
use App\BopSession;
use App\Classes\Viber\ContentType;
use App\Events\InviteBopSession;
use App\Services\Interfaces\ViberServiceInterface;
use Config;

class NotifyApplicant
{
    protected $viber;

    public function __construct(ViberServiceInterface $viber)
    {
        $this->viber = $viber;
    }

    /**
     * Handle the event.
     */
    public function handle(InviteBopSession $event)
    {
        $applicant = Applicant::where('id', $event->applicant_id)->first();
        $session = BopSession::where('id', $event->session_id)->first();

        $text = $this->viber->getMetaValueByKey('bop_session_msg')->text.' '.$session->title;
        $image = $this->viber->getMetaValueByKey('bop_session_msg')->image;
        $link = $session->url;

        // Set Viber Content
        $viber_content = new ContentType();
        $viber_content->setText($text);
        $viber_content->setImage($image);
        $viber_content->setAction($link);

        $this->viber->send($applicant->phone, Config::get('constants.viber.content_type.custom'), $viber_content);
    }
}
