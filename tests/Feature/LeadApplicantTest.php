<?php

namespace Tests\Feature;

use App\Applicant;
use App\BOPSession;
use App\Status;
use App\User;
use DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use JWTAuth;
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
        Event::fake();

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
    public function leadNewApplicantOnAcceptedShouldBeSetAsBopNew()
    {
        // given
        $new_status_id = Status::where('title', 'New')->first()->id;
        $applicant = factory(Applicant::class)->create([
            'phone' => '09796874359',
            'current_status' => 'lead',
            'status_id' => $new_status_id,
        ]);

        $session = factory(BOPSession::class)->create();

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

        Event::assertDispatched(InviteBOPSession::class);
        $invited_session = DB::table('applicant_b_o_p_session')
            ->where('applicant_id', $applicant->id)
            ->where('b_o_p_session_id', $session->id)
            ->where('attendance_status', 'invited')->first();

        $this->assertEquals($invited_session->id, $session->id);

        Event::assertDispatched(NotifiedApplicant::class);
    }
}
