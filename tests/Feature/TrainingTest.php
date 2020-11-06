<?php

namespace Tests\Feature;

use App\Training;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TrainingTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /** @test */
    public function admin_can_add_training()
    {
        $this->withoutExceptionHandling();

        $admin = factory(User::class)->create([
            'is_admin' => 1,
            'is_bdm' => 0,
            'is_ma' => 0,
            'is_staff' => 0,
        ]);

        $response = $this->actingAs($admin)->post(route('trainings.store'), [
            'name' => $title = $this->faker->name
        ]);

        $response->assertRedirect('/trainings');

        $training = Training::find(1);
        $this->assertEquals($title, $training->name);
        $this->assertEquals(1, $training->enable);
    }
}
