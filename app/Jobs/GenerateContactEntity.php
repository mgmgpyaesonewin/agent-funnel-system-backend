<?php

namespace App\Jobs;

use App\Applicant;
use App\Classes\Entity\ContactEntity;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class GenerateContactEntity implements ShouldQueue
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
        $bankEntity = new ContactEntity($applicants);
        $bankEntity->generateFileName('CONT');
        $bankEntity->generateFile();
    }
}
