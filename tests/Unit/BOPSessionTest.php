<?php

namespace Tests\Unit;

use App\Applicant;
use App\BopSession;
use App\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class BopSessionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function itHasTitleSessionDateTimeURL()
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
    public function itShouldShownInApplicantDetail()
    {
        // given
        $sessions = factory(BopSession::class, 3)->create();
        $applicant = factory(Applicant::class)->create([
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
