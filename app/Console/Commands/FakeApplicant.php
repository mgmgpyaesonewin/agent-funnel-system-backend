<?php

namespace App\Console\Commands;

use App\Applicant;
use App\Contract;
use App\Http\Controllers\ApplicantController;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FakeApplicant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fake:applicants {count}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fake Applicants';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        factory(Applicant::class, (int) $this->argument('count'))->create([
            'current_status' => 'active',
            'status_id' => 8,
        ])->each(function (Applicant $applicant, $index) {
            $applicantController = new ApplicantController();
            $applicant->agent_code = $applicantController->generateAgentCode($index);
            $applicant->temp_id = 'FA'.str_pad($applicant->id, 6, '0', STR_PAD_LEFT);
            factory(Contract::class)->create([
                'applicant_id' => $applicant->id
            ]);
            $applicant->save();
            $applicant->statuses()->attach(1, [
                'current_status' => 'onboard',
                'user_id' => 1,
                'created_at' => Carbon::now()->subDays(3)
            ]);
            $applicant->statuses()->attach(8, [
                'current_status' => 'active',
                'user_id' => 1,
            ]);
        });
        Log::info("Applicants {$this->argument('count')} is generated");
    }
}
