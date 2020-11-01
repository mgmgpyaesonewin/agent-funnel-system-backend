<?php

namespace Tests\Feature;

use App\Applicant;
use App\Status;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PMLIFilterApplicantTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

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
    public function generate_temporary_id()
    {
        $new_status_id = Status::where('title', 'New')->first()->id;
        $accepted_status_id = Status::where('title', 'Accepted')->first()->id;

        $applicant = factory(Applicant::class)->create([
            'phone' => '09796874359',
            'current_status' => 'pru_dna_test',
            'status_id' => $new_status_id,
        ]);

        $this->actingAs($this->admin, 'api')->post("/api/applicants/update/{$applicant->id}", [
            'current_status' => 'pmli_filter',
            'status_id' => $accepted_status_id
        ]);

        $updated_applicant = Applicant::where('id', $applicant->id)->first();

        $this->assertEquals('training', $updated_applicant->current_status);
        $this->assertEquals($new_status_id, $updated_applicant->status_id);
        $this->assertNotNull($updated_applicant->temp_id);
    }
}
