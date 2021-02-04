<?php

namespace App\Jobs;

use App\Applicant;
use App\Classes\Entity\ProducerEntity;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

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
        Log::info('Handle Producer Applicants generate');
        $applicants_ids = get_applicants_ids_to_generate();
        $applicants = Applicant::with('statuses')->whereIn('id', $applicants_ids)->get();
        $producerEntity = new ProducerEntity($applicants);
        $producerEntity->generateFileName('PROD');
        $producerEntity->generateFile();
        $applicants_count = count($applicants_ids);
        Log::info("{$applicants_count} Applicants generated");
    }
}
