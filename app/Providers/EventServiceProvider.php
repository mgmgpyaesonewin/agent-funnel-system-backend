<?php

namespace App\Providers;

use App\Events\ApplicantUpdating;
use App\Events\InviteBOPSession;
use App\Listeners\GenerateTemporaryId;
use App\Listeners\InviteApplicantBOPSession;
use App\Listeners\NotifyApplicant;
use App\Listeners\SendViberNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ApplicantUpdating::class => [
            GenerateTemporaryId::class,
            SendViberNotification::class,
        ],
        InviteBOPSession::class => [
            InviteApplicantBOPSession::class,
            NotifyApplicant::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
