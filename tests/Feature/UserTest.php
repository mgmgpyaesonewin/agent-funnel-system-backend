<?php

namespace Tests\Feature;

use App\Models\Partner;
use App\Models\User;
use Hash;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_create_a_partner_user()
    {
        $this->withoutExceptionHandling();

        $admin = User::factory()->create([
            'is_admin' => 1,
            'is_bdm' => 0,
            'is_ma' => 0,
            'is_staff' => 0,
        ]);

        $partner = Partner::factory()->create();

        $this->actingAs($admin)->post(route('users.store'), [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'abcd1234',
            'role' => 'partner',
            'partner_id' => $partner->id
        ]);

        $user = User::find(2);

        $this->assertEquals($partner->slug, $user->utm_source);
    }

    /** @test */
    public function a_bdm_can_see_his_utm_link_in_nav()
    {
        $this->withoutExceptionHandling();

        $bdm = User::factory()->create([
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

        $admin = User::factory()->create([
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

    /** @test */
    public function  a_user_belongs_to_a_partners(): void
    {
        $this->withoutExceptionHandling();

        $partner = Partner::factory()->create();
        $user = User::factory()->create(['partner_id' => $partner->id]);

        $this->assertInstanceOf(Collection::class, $partner->users);
        $this->assertInstanceOf(User::class, $partner->users->first());
        $this->assertEquals($user->id, $partner->users->first()->id);
    }
}
