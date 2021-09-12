<?php

namespace Database\Factories;

use App\Models\BopSession;
use Illuminate\Database\Eloquent\Factories\Factory;

class BOPSessionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BopSession::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'session' => now()->addDays(2),
            'url' => $this->faker->url,
        ];
    }
}
