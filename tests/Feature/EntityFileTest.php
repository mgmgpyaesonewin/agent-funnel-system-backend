<?php

namespace Tests\Feature;

use App\Applicant;
use App\Http\Controllers\ApplicantController;
use App\Jobs\GenerateProducerAdditionalInformationEntity;
use App\Jobs\GenerateProducerEntity;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EntityFileTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();

        $this->admin = factory(User::class)->create([
            'is_admin' => 1,
            'is_bdm' => 0,
            'is_ma' => 0,
            'is_staff' => 0,
        ]);

        $admin = $this->admin;

        factory(Applicant::class, 25)->create()->each(function (Applicant $applicant, $index) use ($admin) {
            $applicantController = new ApplicantController();
            $applicant->agent_code = $applicantController->generateAgentCode($index);
            $applicant->save();
            $applicant->statuses()->attach(8, [
                'current_status' => 'active',
                'user_id' => $admin->id,
            ]);
        });
    }

    /** @test */
    public function generate_producer_entity_file()
    {
        $job = new GenerateProducerEntity();
        $job->handle();
    }

    public function generate_producer_additional_entity_file()
    {
        $job = new GenerateProducerAdditionalInformationEntity();
        $job->handle();
    }
}
