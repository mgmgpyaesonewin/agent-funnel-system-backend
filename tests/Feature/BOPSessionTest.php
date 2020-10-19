<?php

namespace Tests\Feature;

use App\BOPSession;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class BOPSessionTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = factory(User::class)->create([
            'is_admin' => 1,
            'is_bdm' => 0,
            'is_ma' => 0,
            'is_staff' => 0,
        ]);
    }

    /**
     * @test
     */
    public function prudentialAdminCanCreateBOPSession()
    {
        $this->withoutExceptionHandling();
        $session = factory(BOPSession::class)->make();

        $response = $this->actingAs($this->admin)->post('/sessions', [
            'title' => $session->title,
            'date' => $session->session->toDateString(),
            'time' => $session->session->toTimeString(),
            'url' => $session->url,
        ]);

        $created_session = BOPSession::first();

        $response->assertStatus(200);
        $response->assertViewIs('pages.b_o_p_session.index');
        $this->assertEquals($session->title, $created_session->title);
        $this->assertEquals(Carbon::parse($session->session)->toDateString(), Carbon::parse($created_session->session)->toDateString());
        $this->assertEquals(Carbon::parse($session->session)->toTimeString(), Carbon::parse($created_session->session)->toTimeString());
        $this->assertEquals($session->url, $created_session->url);
    }

    /** @test */
    public function userCanSeeBOPSessions()
    {
        $sessions = factory(BOPSession::class, 15)->create();

        $response = $this->actingAs($this->admin)->get('/sessions');

        $data = $response->getOriginalContent()->getData();

        $response->assertStatus(200);
        $response->assertViewIs('pages.b_o_p_sessions.index');
        $this->assertCount(count($sessions), $data['sessions']);
    }
}
