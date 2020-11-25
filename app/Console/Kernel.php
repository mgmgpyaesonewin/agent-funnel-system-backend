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
use App\Setting;
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
        $schedule->job(new GenerateContactEntity())->withoutOverlapping()->everyMinute(); // CONT
        $schedule->job(new GenerateContractEntity())->withoutOverlapping()->everyMinute(); // CONTR
        $schedule->job(new GenerateEducationEntity())->withoutOverlapping()->everyMinute(); // EDU
        $schedule->job(new GenerateLicenseEntity())->withoutOverlapping()->everyMinute(); // LICN
        $schedule->job(new GeneratePayeeBankEntity())->withoutOverlapping()->everyMinute(); // BANK
        $schedule->job(new GenerateProducerAdditionalInformationEntity())->withoutOverlapping()->everyMinute(); // ADD_INFO
        $schedule->job(new GenerateProducerEntity())->withoutOverlapping()->everyMinute(); // PROD
        $schedule->job(new GenerateRelatedPersonEntity())->withoutOverlapping()->everyMinute(); // Related person

        $applicants = Setting::where('meta_key', 'applicants_count')->first();
        $count = (int) $applicants->meta_value + 5;
        $schedule->command("fake:applicant {$count}");
        $applicants->meta_value = $count;
        $applicants->save();
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
