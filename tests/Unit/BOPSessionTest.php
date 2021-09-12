<?php

namespace Tests\Unit;

use App\Models\Applicant;
use App\Models\BopSession;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class BOPSessionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_title_session_date_time_url(): void
    {
        $dateTime = now();

        $session = BopSession::create([
            'title' => 'Some Title',
            'session' => $dateTime,
            'url' => 'Some URL',
        ]);

        $this->assertEquals('Some Title', $session->title);
        $this->assertEquals($dateTime, $session->session);
        $this->assertEquals('Some URL', $session->url);
    }

    /** @test */
    public function it_should_shown_in_applicant_detail(): void
    {
        // given
        $sessions = BopSession::factory()->count(3)->create();
        $applicant = Applicant::factory()->create([
            'current_status' => 'bop_session',
            'status_id' => Status::where('title', 'New')->first()->id,
        ]);

        foreach ($sessions as $session) {
            $applicant->inviteBopSession($session->id);
        }

        // when
        $sessions = $applicant->bop_sessions()->count();

        // then
        $this->assertEquals(3, $sessions);
    }
}
