<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Applicant;
use Faker\Generator as Faker;

$factory->define(Applicant::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'photo' => 'photo_string',
        'nrc' => $faker->numerify('12/SaKhaNa(N)######'),
        'dob' => $faker->dateTimeBetween('-30 years', '-18 years'),
        'gender' => $faker->numberBetween(0, 1),
        'phone' => $faker->phoneNumber,
        'email' => $faker->freeEmail,
        'address' => $faker->address,
        'education' => json_encode([
            [
                'degree' => 'B.Sc Computer Science',
                'university' => 'UCSY',
                'graduated_year' => '2018',
            ],
            [
                'degree' => 'Diploma in Networking',
                'university' => 'Youth',
                'graduated_year' => '2015',
            ],
        ]),
        'working_experience' => json_encode([
            [
                'type' => 'employed',
                'title' => $faker->jobTitle,
                'company' => $faker->company,
                'start_date' => $faker->date('d-m-Y'),
                'end_date' => $faker->date('d-m-Y'),
            ],
        ]),
        'is_chatesat_freelancer' => $faker->numberBetween(0, 1),
        'referral_code' => $faker->word,
        'cv_attachment' => 'attachment_File',
        'is_webinar_available' => $faker->numberBetween(0, 1),
        'is_training_available' => $faker->numberBetween(0, 1),
        'is_prudential_available' => $faker->numberBetween(0, 1),
        'status_id' => $faker->numberBetween(1, 12),
    ];
});
