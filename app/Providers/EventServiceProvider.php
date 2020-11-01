<?php

namespace App\Providers;

use App\Events\ApplicantUpdating;
use App\Events\InviteBopSession;
use App\Listeners\GenerateTemporaryId;
use App\Listeners\InviteApplicantBopSession;
use App\Listeners\NotifyApplicant;
use App\Listeners\SendViberNotification;
use App\Listeners\AssignBDMWhenMAisAssigned;
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
            AssignBDMWhenMAisAssigned::class,
        ],
        InviteBopSession::class => [
            InviteApplicantBopSession::class,
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
