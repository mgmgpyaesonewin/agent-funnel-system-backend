<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function a_bdm_can_see_his_utm_link_in_nav()
    {
        $this->withoutExceptionHandling();

        $bdm = factory(User::class)->create([
            'is_admin' => 0,
            'is_bdm' => 1,
            'is_ma' => 0,
            'is_staff' => 0,
        ]);

        $response = $this->actingAs($bdm)->get('/users');
        $response->assertStatus(200);

        $bdm = User::find(1);
        $utm = $bdm->utm_source;
        $response->assertSeeText($utm);
    }
}
