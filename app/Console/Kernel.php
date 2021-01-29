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
use Log;

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
        foreach (['14:00', '15:00', '2:00', '3:00'] as $time) {
            Log::info('Running File Export');

            $schedule->job(new GenerateContactEntity())->dailyAt($time); // CONT
            Log::info('Running File Export GenerateContactEntity');

            $schedule->job(new GenerateContractEntity())->dailyAt($time); // CONTR
            Log::info('Running File Export GenerateContractEntity');

            $schedule->job(new GenerateEducationEntity())->dailyAt($time); // EDU
            Log::info('Running File Export GenerateEducationEntity');

            $schedule->job(new GenerateLicenseEntity())->dailyAt($time); // LICN
            Log::info('Running File Export GenerateLicenseEntity');

            $schedule->job(new GeneratePayeeBankEntity())->dailyAt($time); // BANK
            Log::info('Running File Export GeneratePayeeBankEntity');

            $schedule->job(new GenerateProducerAdditionalInformationEntity())->dailyAt($time); // ADD_INFO
            Log::info('Running File Export GenerateProducerAdditionalInformationEntity');

            $schedule->job(new GenerateProducerEntity())->dailyAt($time); // PROD
            Log::info('Running File Export GenerateProducerEntity');

            $schedule->job(new GenerateRelatedPersonEntity())->dailyAt($time); // Related person
            Log::info('Running File Export GenerateRelatedPersonEntity');
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
