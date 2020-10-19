<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BOPSession;
use Faker\Generator as Faker;

$factory->define(BOPSession::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'session' => now()->addDays(2),
        'url' => $faker->url,
    ];
});
