<?php

namespace Tests\Feature;

use App\Applicant;
use App\Jobs\GenerateProducerEntity;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProducerEntityFileTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function generate_producer_entity_file()
    {
        $admin = factory(User::class)->create([
            'is_admin' => 1,
            'is_bdm' => 0,
            'is_ma' => 0,
            'is_staff' => 0,
        ]);

        factory(Applicant::class, 5)->create([
            'agent_code' => '02,000,008'
        ])->each(function ($applicant) use ($admin) {
            $applicant->statuses()->attach(8, [
                'current_status' => 'active',
                'user_id' => $admin->id,
            ]);
        });

        $job = new GenerateProducerEntity();
        $job->handle();
    }
}
