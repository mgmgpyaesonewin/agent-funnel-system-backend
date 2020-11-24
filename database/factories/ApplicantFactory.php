<?php

/** @var Factory $factory */

use App\Applicant;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
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
        'education' => $faker->randomElement([
            'Primary Education',
            'Secondary Education',
            'Matriculation',
            'Graduate',
            'Post Graduate',
            'Diploma or equivalent',
        ]),
        'race' => $faker->randomElement([
            'Kachin',
            'Kayah',
            'Kayin',
            'Chin',
            'Burma',
            'Mon',
            'Rakhine',
            'Shan',
        ]),
        'myanmar_citizen' => $faker->numberBetween(0, 1),
        'citizen' => $faker->country,
        'married' => $faker->randomElement(['Single', 'Married', 'Divorced', 'Widowed']),
        'employment' => json_encode([
            [
                'income' => '$ 2000',
                'address' => 'Yangon',
                'position' => 'Sales',
                'company_name' => 'GGI',
                'industry_type' => 'Insurance',
                'duration_to_date' => '2020-11-11',
                'duration_from_date' => '2020-01-01'
            ],
            [
                'income' => '1000000 MMK',
                'address' => 'Sule Square',
                'position' => 'Manager',
                'company_name' => 'Company1',
                'industry_type' => 'Service',
                'duration_to_date' => '2020-11-04',
                'duration_from_date' => '2017-01-01'
            ]
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
        'city_id' => 2,
        'township_id' => 2,
        'spouse_name' => $faker->name,
        'spouse_nrc' => $faker->numerify('12/SaKhaNa(N)######'),
        'bank_account_name' => $faker->name,
        'bank_account_no' => $faker->numerify('###-###-###-##'),
        'license_no' => $faker->numerify('###-###-###'),
    ];
});
