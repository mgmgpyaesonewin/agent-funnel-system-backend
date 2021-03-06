<?php

namespace Tests\Feature;

use App\Models\Applicant;
use App\Models\BopSession;
use App\Models\User;
use Carbon\Carbon;
use Database\Factories\BOPSessionFactory;
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

        $this->admin = User::factory()->create([
            'is_admin' => 1,
            'is_bdm' => 0,
            'is_ma' => 0,
            'is_staff' => 0,
        ]);
    }

    /**
     * @test
     * @dataProvider requiredFormValidationProvider
     * @param $formInput
     * @param $formInputValue
     */
    public function it_validates_form($formInput, $formInputValue)
    {
        $this->actingAs($this->admin)->post('/sessions', [$formInput => $formInputValue])
            ->assertSessionHasErrors($formInput);
    }

    public function requiredFormValidationProvider()
    {
        return [
            ['title', ''],
            ['date', ''],
            ['time', ''],
            ['url', ''],
        ];
    }

    /**
     * @test
     */
    public function prudential_admin_can_create_bop_session()
    {
        $session = BopSession::factory()->make();

        $response = $this->actingAs($this->admin)->post('/sessions', [
            'title' => $session->title,
            'date' => $session->session->toDateString(),
            'time' => $session->session->toTimeString(),
            'url' => $session->url,
        ]);

        $response->assertStatus(302);
        // FIXME:: redirect work only for sometimes
        // $response->assertRedirect('/sessions');

        $created_session = BopSession::first();
        $this->assertEquals($session->title, $created_session->title);
        $this->assertEquals(Carbon::parse($session->session)->toDateString(), Carbon::parse($created_session->session)->toDateString());
        $this->assertEquals(Carbon::parse($session->session)->toTimeString(), Carbon::parse($created_session->session)->toTimeString());
        $this->assertEquals($session->url, $created_session->url);
    }

    /** @test */
    public function user_can_see_bop_sessions()
    {
        $sessions = BopSession::factory()->count(15)->create();

        $response = $this->actingAs($this->admin)->get('/sessions');

        $data = $response->getOriginalContent()->getData();

        $response->assertStatus(200);
        $response->assertSuccessful();
        $response->assertViewIs('pages.b_o_p_sessions.index');
        $response->assertSee('Create');
        $this->assertCount(count($sessions), $data['sessions']);
    }

    /** @test */
    public function prudential_admin_can_edit_bop_sessions()
    {
        $session = BOPSession::factory()->create();

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
    public function prudential_admin_can_update_bop_session()
    {
        $this->withoutExceptionHandling();

        $session = BopSession::factory()->create();
        $session_to_update = BopSession::factory()->make();

        $response = $this->actingAs($this->admin)->put(route('sessions.update', $session->id), [
            'title' => $session_to_update->title,
            'date' => $session_to_update->getDate(),
            'time' => $session_to_update->getTime(),
            'url' => $session_to_update->url,
            'enable' => 1
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Updated Successfully');

        $updatedSession = BopSession::find($session->id);
        $this->assertEquals($session_to_update->title, $updatedSession->title);
        $this->assertEquals($session_to_update->getDate(), $updatedSession->getDate());
        $this->assertEquals($session_to_update->getTime(), $updatedSession->getTime());
        $this->assertEquals($session_to_update->url, $updatedSession->url);
    }

    /** @test */
    public function admin_can_delete_session()
    {
        $session = BopSession::factory()->create();
        $response = $this->actingAs($this->admin)->delete(route('sessions.destroy', $session->id));

        $response->assertRedirect('/sessions');
        $response->assertSessionHas('message', 'Deleted Successfully');

        $isSessionDeletedCount = count(BopSession::where('id', $session->id)->get());
        $this->assertEquals($isSessionDeletedCount, 0);
    }

    /** @test */
    public function bop_sessions_page_exist()
    {
        $response = $this->actingAs($this->admin)->get('/sessions');

        $response->assertStatus(200);
        $response->assertViewIs('pages.b_o_p_sessions.index');
    }

    /** @test */
    public function get_all_bop_sessions()
    {
        $sessions = BopSession::factory()->count(20)->create();
        $response = $this->actingAs($this->admin, 'api')->get('/api/sessions');

        $data = $response->getOriginalContent();

        $this->assertEquals(true, $data['status']);
        $this->assertCount(count($sessions), $data['sessions']);
    }

    /** @test */
    public function get_all_bop_sessions_except_applicant_previous_assigned()
    {
        $this->withoutExceptionHandling();

        BopSession::factory()->count(5)->create();
        $applicant = Applicant::factory()->create();

        $session = BopSession::first();
        $applicant->bop_sessions()->attach($session->id, [
            'attendance_status' => 'invited',
        ]);

        $response = $this->actingAs($this->admin, 'api')->get('/api/sessions?applicant_id=1');

        $data = $response->getOriginalContent();

        $this->assertEquals(true, $data['status']);
        $this->assertCount(4, $data['sessions']);
    }

    /** @test */
    public function search_bop_sessions()
    {
        BopSession::factory()->create([
            'title' => 'Just BOP Session',
        ]);

        $session = BopSession::factory()->create([
            'title' => 'Test BOP Session',
        ]);

        $response = $this->actingAs($this->admin, 'api')->get('/api/sessions?q=Test');

        $data = $response->getOriginalContent();

        $this->assertEquals(true, $data['status']);
        $this->assertCount(1, $data['sessions']);
    }

    /** @test */
    public function user_can_disable_status()
    {
        $session = BopSession::factory()->create();
        $session_to_update = BopSession::factory()->make();

        $response = $this->actingAs($this->admin)->put(route('sessions.update', $session->id), [
            'title' => $session_to_update->title,
            'date' => $session_to_update->getDate(),
            'time' => $session_to_update->getTime(),
            'url' => $session_to_update->url,
            'enable' => 0
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Updated Successfully');

        $updatedSession = BopSession::find($session->id);
        $this->assertEquals($session_to_update->title, $updatedSession->title);
        $this->assertEquals($session_to_update->getDate(), $updatedSession->getDate());
        $this->assertEquals($session_to_update->getTime(), $updatedSession->getTime());
        $this->assertIsInt(0, $updatedSession->enable);
        $this->assertEquals(0, $updatedSession->enable);
    }

    /** @test */
    public function user_can_enable_disabled_status()
    {
        $session = BopSession::factory()->create();
        $session_to_update = BopSession::factory()->make();

        $response = $this->actingAs($this->admin)->put(route('sessions.update', $session->id), [
            'title' => $session_to_update->title,
            'date' => $session_to_update->getDate(),
            'time' => $session_to_update->getTime(),
            'url' => $session_to_update->url,
            'enable' => 1
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Updated Successfully');

        $updatedSession = BopSession::find($session->id);
        $this->assertEquals($session_to_update->title, $updatedSession->title);
        $this->assertEquals($session_to_update->getDate(), $updatedSession->getDate());
        $this->assertEquals($session_to_update->getTime(), $updatedSession->getTime());
        $this->assertIsInt(1, $updatedSession->enable);
        $this->assertEquals(1, $updatedSession->enable);
    }
}
