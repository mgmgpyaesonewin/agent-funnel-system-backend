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
        $this->withoutExceptionHandling();

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
        $session = factory(BOPSession::class)->make();

        $response = $this->actingAs($this->admin)->post('/sessions', [
            'title' => $session->title,
            'date' => $session->session->toDateString(),
            'time' => $session->session->toTimeString(),
            'url' => $session->url,
        ]);

        $created_session = BOPSession::first();

        $response->assertRedirect('/sessions');
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

    /** @test */
    public function prudentialAdminCanEditBOPSessions()
    {
        $session = factory(BOPSession::class)->create();

        $response = $this->actingAs($this->admin)->get("/sessions/{$session->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('pages.b_o_p_sessions.edit');

        $data = $response->getOriginalContent()->getData();
        $this->assertEquals($session->id, $data['session']->id);
        $this->assertEquals($session->title, $data['session']->title);
        $this->assertEquals($session->session, $data['session']->session);
        $this->assertEquals($session->url, $data['session']->url);
    }

    /** @test */
    public function prudentialAdminCanUpdateBOPSession()
    {
        $session = factory(BOPSession::class)->create();
        $session_to_update = factory(BOPSession::class)->make();

        $response = $this->actingAs($this->admin)->put(route('sessions.update', $session->id), [
            'title' => $session_to_update->title,
            'date' => $session_to_update->getDate(),
            'time' => $session_to_update->getTIme(),
            'url' => $session_to_update->url,
        ]);

        $response->assertRedirect('/sessions');
        $response->assertSessionHas('message', 'Updated Successfully');

        $updatedSession = BOPSession::find($session->id);
        $this->assertEquals($session_to_update->title, $updatedSession->title);
        $this->assertEquals($session_to_update->getDate(), $updatedSession->getDate());
        $this->assertEquals($session_to_update->getTime(), $updatedSession->getTime());
        $this->assertEquals($session_to_update->url, $updatedSession->url);
    }

    /** @test */
    public function adminCanDeleteSession()
    {
        $session = factory(BOPSession::class)->create();
        $response = $this->actingAs($this->admin)->delete(route('sessions.destroy', $session->id));

        $response->assertRedirect('/sessions');
        $response->assertSessionHas('message', 'Deleted Successfully');

        $isSessionDeletedCount = count(BOPSession::where('id', $session->id)->get());
        $this->assertEquals($isSessionDeletedCount, 0);
    }
}
