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
     * @param InviteBopSession $event
     */
    public function handle(InviteBopSession $event)
    {
        $applicant = Applicant::find($event->applicant_id);
        $session = BopSession::where('id', $event->session_id)->first();

        $text = $this->viber->getMetaValueByKey($this->getViberMetaKeyValue($applicant))->text." Date: {$session->getViberDateFormat()} | Link: {$session->url}";
        $image = $this->viber->getMetaValueByKey('bop_session_msg')->image;
        $link = $session->url;

        // Set Viber Content
        $viber_content = new ContentType();
        $viber_content->setText($text);
        $viber_content->setImage($image);
        $viber_content->setAction($link);

        $this->viber->send($applicant->phone, Config::get('constants.viber.content_type.custom'), $viber_content);
    }

    public function getViberMetaKeyValue(Applicant $applicant): string
    {
        if ($this->shouldReassignBopSession($applicant)) {
            return 'bop_session_reassign_msg';
        }
        return 'bop_session_msg';
    }

    public function shouldReassignBopSession(Applicant $applicant)
    {
        return $applicant->bop_sessions()->count() > 1;
    }
}
