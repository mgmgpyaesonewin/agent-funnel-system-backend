<?php

namespace App\Listeners;

use App\Events\ApplicantUpdating;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateTemporaryId
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ApplicantUpdating  $event
     * @return void
     */
    public function handle(ApplicantUpdating $event)
    {
        //
    }
}
