<?php

namespace Tests\Feature;

use App\User;
use Hash;
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

    /** @test */
    public function a_user_can_edit_his_information()
    {
        $this->withoutExceptionHandling();

        $admin = factory(User::class)->create([
            'is_admin' => 1,
            'is_bdm' => 0,
            'is_ma' => 0,
            'is_staff' => 0,
        ]);

        $response = $this->actingAs($admin)->put(route('users.update', $admin->id), [
            'name' => 'Pyae Sone',
            'email' => 'pyaesone@pyae.dev',
            'password' => 'abcd1234',
            'role' => 'is_bdm'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/users');

        $user = User::find(1);
        $this->assertEquals('Pyae Sone', $user->name);
        $this->assertEquals('pyaesone@pyae.dev', $user->email);

        $passwordMatch = Hash::check('abcd1234', $user->password);
        $this->assertTrue($passwordMatch);
        $this->assertEquals(0, $user->is_admin);
        $this->assertEquals(1, $user->is_bdm);
        $this->assertEquals(0, $user->is_ma);
        $this->assertEquals(0, $user->is_staff);
    }
}
