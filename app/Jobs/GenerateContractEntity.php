<?php

namespace App\Jobs;

use App\Applicant;
use App\Classes\Entity\ContactEntity;
use App\Classes\Entity\ContractEntity;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class GenerateContractEntity implements ShouldQueue
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
        $applicants_ids = Applicant::withActivatedWithinInterval()->pluck('applicants.id')->toArray();
        $applicants = Applicant::with('statuses')->whereIn('id', $applicants_ids)->get();
        $bankEntity = new ContractEntity($applicants);
        $bankEntity->generateFileName('CONTR');
        $bankEntity->generateFile();
    }
}
