<?php

namespace Tests\Unit;

use App\User;
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
    public function user_have_their_own_utm()
    {
        $user = factory(User::class)->create([
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
    public function ma_have_owns_bdm()
    {
        $bdm = factory(User::class)->create([
            'name' => $this->faker->name,
            'is_admin' => 0,
            'is_bdm' => 1,
            'is_ma' => 0,
            'is_staff' => 0,
        ]);

        $ma = factory(User::class)->create([
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
    public function bdm_have_owns_ma_users()
    {
        $bdm = factory(User::class)->create([
            'name' => $this->faker->name,
            'is_admin' => 0,
            'is_bdm' => 1,
            'is_ma' => 0,
            'is_staff' => 0,
        ]);

        $ma_1 = factory(User::class)->create([
            'name' => $this->faker->name,
            'is_admin' => 0,
            'is_bdm' => 0,
            'is_ma' => 1,
            'is_staff' => 0,
            'user_id' => $bdm->id
        ]);

        factory(User::class)->create([
            'name' => $this->faker->name,
            'is_admin' => 0,
            'is_bdm' => 0,
            'is_ma' => 1,
            'is_staff' => 0,
            'user_id' => $bdm->id
        ]);

        factory(User::class)->create([
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
}
