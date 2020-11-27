<?php

namespace App\Jobs;

use App\Applicant;
use App\Classes\Entity\AdditionalInformationEntity;
use App\Classes\Entity\ProducerEntity;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateProducerAdditionalInformationEntity implements ShouldQueue
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
        $applicants_ids = get_applicants_ids_to_generate();
        $applicants = Applicant::with('statuses')->whereIn('id', $applicants_ids)->get();
        $producerEntity = new AdditionalInformationEntity($applicants);
        $producerEntity->generateFileName('ADD_INFO');
        $producerEntity->generateFile();
    }
}
