<?php

namespace Tests\Feature;

use App\Applicant;
use App\BopSession;
use App\Setting;
use App\Status;
use App\User;
use DB;
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

        // $token = JWTAuth::fromUser($this->admin);
        // $this->admin->token = $token;
    }

    /** @test */
    public function lead_new_applicant_on_accepted_should_be_set_as_bop_new()
    {
        // given
        $new_status_id = Status::where('title', 'New')->first()->id;
        $applicant = factory(Applicant::class)->create([
            'phone' => '09796874359',
            'current_status' => 'lead',
            'status_id' => $new_status_id,
        ]);

        $session = factory(BopSession::class)->create();
        factory(Setting::class)->create([
            'meta_key' => 'bop_session_msg',
        ]);

        // when
        $this->actingAs($this->admin, 'api')->post("/api/applicants/update/{$applicant->id}", [
            'current_status' => 'bop_session',
            'status_id' => $new_status_id,
            'session_id' => $session->id,
        ]);

        // then
        $updated_applicant = Applicant::where('id', $applicant->id)->first();
        $this->assertEquals('bop_session', $updated_applicant->current_status);
        $this->assertEquals($updated_applicant->status_id, $new_status_id);

        $applicant_status = DB::table('applicant_status')->where('applicant_id', $updated_applicant->id)->latest()->first();
        $this->assertEquals($applicant_status->current_status, 'bop_session');
        $this->assertEquals($applicant_status->status_id, $new_status_id);

        $invited_session = DB::table('applicant_bop_session')
            ->where('applicant_id', $applicant->id)
            ->where('bop_session_id', $session->id)
            ->where('attendance_status', 'invited')->first();

        $this->assertEquals($invited_session->id, $session->id);
    }

    /** @test */
    public function lead_new_not_interested_applicants_should_be_set_as_bop_session_rejected()
    {
        // given
        $status_new_id = Status::where('title', 'New')->first()->id;
        $status_rejected_id = Status::where('title', 'Rejected')->first()->id;
        $applicant = factory(Applicant::class)->create([
            'phone' => '09796874359',
            'current_status' => 'lead',
            'status_id' => $status_new_id,
        ]);

        // when
        $this->actingAs($this->admin, 'api')->post("/api/applicants/update/{$applicant->id}", [
            'current_status' => 'bop_session',
            'status_id' => $status_rejected_id,
        ]);

        // then
        $updated_applicant = Applicant::where('id', $applicant->id)->first();

        $this->assertEquals('bop_session', $updated_applicant->current_status);
        $this->assertEquals($updated_applicant->status_id, $status_rejected_id);
    }

    /** @test */
    public function new_applicant_with_bdm_utm_source_should_be_assign_for_bdm()
    {
        $bdm = factory(User::class)->create([
            'is_admin' => 0,
            'is_bdm' => 1,
            'is_ma' => 0,
            'is_staff' => 0,
        ]);

        $applicant = factory(Applicant::class)->make();

        $this->post('/api/createuser', [
            'name' => $applicant->name,
            'dob' => $applicant->dob,
            'gender' => 'male',
            'phone' => '09796874359',
            'utm_source' => $bdm->utm_source,
        ]);

        $created_applicant = Applicant::first();

        $this->assertEquals($bdm->id, $created_applicant->assign_bdm_id);
    }
}
