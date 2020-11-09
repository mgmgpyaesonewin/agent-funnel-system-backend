<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Applicant;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Applicant::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'preferred_name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'dob' => $faker->dateTimeBetween('-30 years', '-18 years'),
        'uuid' => (string) Str::uuid(),
        'gender' => $faker->numberBetween(0, 1),
        'nrc' => $faker->numerify('12/SaKhaNa(N)######'),
        'current_status' => 'pre_filter',
        'email' => $faker->freeEmail,
        'address' => $faker->address,
        'education' => 'Master\'s Degree',
        'employment' => json_encode([
            [
                'industry_type' => 'employed',
                'position' => $faker->jobTitle,
                'company_name' => $faker->company,
                'duration' => '12 months',
                'address' => '38, Padather Street, Maynigone',
                'income' => '1,200,000 MMK',
            ],
        ]),
        'agent_exp' => json_encode([
            'company_name' => 'Prudential',
            'address' => $faker->address,
            'position' => $faker->jobTitle,
        ]),
        'family_agent' => json_encode([
            'name' => $faker->name,
            'position' => $faker->jobTitle,
            'agent_code' => 'AA-1001',
            'relation' => 'wife',
            'nrc' => '12/SaKaNa(N)082719',
        ]),
        'status_id' => 1,
    ];
});
