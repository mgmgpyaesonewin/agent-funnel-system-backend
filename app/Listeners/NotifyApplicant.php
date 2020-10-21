<?php

namespace App\Listeners;

use App\Applicant;
use App\BOPSession;
use App\Classes\Viber\ContentType;
use App\Events\InviteBOPSession;
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
    public function handle(InviteBOPSession $event)
    {
        $applicant = Applicant::where('id', $event->applicant_id)->first();
        $session = BOPSession::where('id', $event->session_id)->first();

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
