<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Applicant;
use Faker\Generator as Faker;

$factory->define(Applicant::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'dob' => $faker->dateTimeBetween('-30 years', '-18 years'),
        'gender' => $faker->numberBetween(0, 1),
        'nrc' => $faker->numerify('12/SaKhaNa(N)######'),
        'current_status' => $faker->randomElement(['pre_filter', 'pru_dna_test', 'pmli_filter', 'training', 'certification', 'onboard']),
        'email' => $faker->freeEmail,
        'address' => $faker->address,
        'education' => 'Master\'s Degree',
        'employment' => json_encode([
            [
                'type' => 'employed',
                'title' => $faker->jobTitle,
                'company' => $faker->company,
                'start_date' => $faker->date('d-m-Y'),
                'end_date' => $faker->date('d-m-Y'),
            ],
        ]),
        'status_id' => $faker->numberBetween(1, 4),
    ];
});
