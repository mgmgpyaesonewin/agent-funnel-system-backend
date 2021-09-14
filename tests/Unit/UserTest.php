<?php

namespace Tests\Unit;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function user_have_their_own_utm(): void
    {
        $user = User::factory()->create([
            'name' => 'Pyae Sone',
            'is_admin' => 1,
            'is_bdm' => 0,
            'is_ma' => 0,
            'is_staff' => 0,
        ]);

        $utm = $user->utm_source;
        $this->assertEquals('pyaesone.1', $utm);
    }

    /** @test */
    public function ma_have_owns_bdm(): void
    {
        $bdm = User::factory()->create([
            'name' => $this->faker->name,
            'is_admin' => 0,
            'is_bdm' => 1,
            'is_ma' => 0,
            'is_staff' => 0,
        ]);

        $ma = User::factory()->create([
            'name' => $this->faker->name,
            'is_admin' => 0,
            'is_bdm' => 0,
            'is_ma' => 1,
            'is_staff' => 0,
            'user_id' => $bdm->id
        ]);

        $this->assertEquals($bdm->id, $ma->getParent()->id);
        $this->assertEquals($bdm->name, $ma->getParent()->name);
        $this->assertEquals($bdm->email, $ma->getParent()->email);
    }

    /** @test */
    public function bdm_have_owns_ma_users(): void
    {
        $bdm = User::factory()->create([
            'name' => $this->faker->name,
            'is_admin' => 0,
            'is_bdm' => 1,
            'is_ma' => 0,
            'is_staff' => 0,
        ]);

        $ma_1 = User::factory()->create([
            'name' => $this->faker->name,
            'is_admin' => 0,
            'is_bdm' => 0,
            'is_ma' => 1,
            'is_staff' => 0,
            'user_id' => $bdm->id
        ]);

        User::factory()->create([
            'name' => $this->faker->name,
            'is_admin' => 0,
            'is_bdm' => 0,
            'is_ma' => 1,
            'is_staff' => 0,
            'user_id' => $bdm->id
        ]);

        User::factory()->create([
            'name' => $this->faker->name,
            'is_admin' => 0,
            'is_bdm' => 0,
            'is_ma' => 1,
            'is_staff' => 0,
            'user_id' => $bdm->id
        ]);

        $this->assertEquals(3, $bdm->getMaChildren()->count());
        $this->assertEquals($ma_1->id, $bdm->getMaChildren()->first()->id);
        $this->assertEquals($ma_1->name, $bdm->getMaChildren()->first()->name);
        $this->assertEquals($ma_1->email, $bdm->getMaChildren()->first()->email);
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
