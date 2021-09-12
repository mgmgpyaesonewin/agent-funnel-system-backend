<?php

namespace Tests\Feature;

use App\Models\Applicant;
use App\Models\Setting;
use App\Models\Status;
use App\Models\User;
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

        $this->admin = User::factory()->create([
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

        $applicant = Applicant::factory()->create([
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

    /** @test */
    public function generate_temporary_id_before_payment_if_payment_is_required()
    {
        $new_status_id = Status::where('title', 'New')->first()->id;
        $waiting_payment_status_id = Status::where('title', 'Waiting Payment')->first()->id;

        Setting::factory()->create([
            'meta_key' => 'payment_msg'
        ]);

        Setting::factory()->create([
            'meta_key' => 'payment_mandatory',
            'meta_value' => 1
        ]);

        $applicant = Applicant::factory()->create([
            'phone' => '09796874359',
            'current_status' => 'pru_dna_test',
            'status_id' => $new_status_id,
        ]);

        $this->actingAs($this->admin, 'api')->post("/api/applicants/update/{$applicant->id}", [
            'current_status' => 'pmli_filter',
            'status_id' => $waiting_payment_status_id
        ]);

        $updated_applicant = Applicant::where('id', $applicant->id)->first();

        $this->assertEquals('pmli_filter', $updated_applicant->current_status);
        $this->assertEquals($waiting_payment_status_id, $updated_applicant->status_id);
        $this->assertNotNull($updated_applicant->temp_id);
    }
}
