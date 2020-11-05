<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contract;
use Faker\Generator as Faker;

$factory->define(Contract::class, function (Faker $faker) {
    return [
        'pdf' => 'contracts/09780003637-09_10_20_12_10_12.pdf',
        'signed_date' => $faker->dateTime(),
        'applicant_sign_img' => 'sign/applicant/5mDbHXncV5cRgZnbrj1VgYKYXiLsLdbLvGWVMq6T.png',
        'witness_name' => $faker->name,
        'witness_sign_img' => 'sign/witness/5aQILYlesBGcUvk3txDccJCyIGZHspcwvk9jc3PO.png',
        'version' => 1
    ];
});
