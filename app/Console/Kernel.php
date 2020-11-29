<?php

namespace App\Console;

use App\Jobs\GenerateContactEntity;
use App\Jobs\GenerateContractEntity;
use App\Jobs\GenerateEducationEntity;
use App\Jobs\GenerateLicenseEntity;
use App\Jobs\GeneratePayeeBankEntity;
use App\Jobs\GenerateProducerAdditionalInformationEntity;
use App\Jobs\GenerateProducerEntity;
use App\Jobs\GenerateRelatedPersonEntity;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        foreach (['1:00'] as $time) {
            $schedule->job(new GenerateContactEntity())->dailyAt($time); // CONT
            $schedule->job(new GenerateContractEntity())->dailyAt($time); // CONTR
            $schedule->job(new GenerateEducationEntity())->dailyAt($time); // EDU
            $schedule->job(new GenerateLicenseEntity())->dailyAt($time); // LICN
            $schedule->job(new GeneratePayeeBankEntity())->dailyAt($time); // BANK
            $schedule->job(new GenerateProducerAdditionalInformationEntity())->dailyAt($time); // ADD_INFO
            $schedule->job(new GenerateProducerEntity())->dailyAt($time); // PROD
            $schedule->job(new GenerateRelatedPersonEntity())->dailyAt($time); // Related person
        }
//        $schedule->command('fake:applicant')->dailyAt('7:55');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
