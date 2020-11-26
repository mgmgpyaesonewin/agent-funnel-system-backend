<?php

namespace App\Jobs;

use App\Applicant;
use App\Classes\Entity\ProducerEntity;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class GenerateProducerEntity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $applicants = Applicant::withActivatedWithinInterval()->get();
        $producerEntity = new ProducerEntity($applicants);
        $producerEntity->generateFileName('PROD');
        $producerEntity->generateFile();
    }
}
