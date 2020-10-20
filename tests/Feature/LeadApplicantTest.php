<?php

namespace Tests\Feature;

use App\Applicant;
use App\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class LeadApplicantTest extends TestCase
{
    use RefreshDatabase;

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
    }

    /** @test */
    public function leadNewApplicantOnAcceptedShouldBeSetAsBopNew()
    {
        // given
        $applicant = factory(Applicant::class)->create([
            'current_status' => 'lead',
            'status_id' => Status::where('title', 'New')->first()->id,
        ]);

        // when
        $this->actingAs($this->admin)->post("/applicants/update{$applicant->id}", [
            'current_status' => 'bop_session',
            'status_id' => Status::where('title', 'New')->first()->id,
        ]);

        // then
    }
}
