<?php

namespace App\Jobs;

use App\Applicant;
use App\Classes\Entity\AdditionalInformationEntity;
use App\Classes\Entity\BankEntity;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GeneratePayeeBankEntity implements ShouldQueue
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
        $applicants = Applicant::all();
        $bankEntity = new BankEntity($applicants);
        $bankEntity->generateFileName('BANK');
        $bankEntity->generateFile();
    }
}
