<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Partner;
use Faker\Generator as Faker;

$factory->define(Partner::class, function (Faker $faker) {
    return [
        'company_name' => $faker->company,
        'pic_name' => $faker->name,
        'pic_phone' => $faker->phoneNumber,
        'pic_email' => $faker->email,
    ];
});
