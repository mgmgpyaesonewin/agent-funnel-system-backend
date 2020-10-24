<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function userHaveTheirOwnUTM()
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
}
