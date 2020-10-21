<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Setting;
use Faker\Generator as Faker;

$factory->define(Setting::class, function (Faker $faker) {
    return [
        'meta_key' => 'some_meta_key',
        'meta_value' => json_encode([
            'text' => 'This is text',
            'image' => 'https://dummyimage.com/600x400/000/fff&text=text',
            'url' => 'https://www.google.com/',
        ]),
    ];
});
