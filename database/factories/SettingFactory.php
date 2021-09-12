<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'meta_key' => 'some_meta_key',
            'meta_value' => json_encode([
                'text' => 'This is text',
                'image' => 'https://dummyimage.com/600x400/000/fff&text=text',
                'url' => 'https://www.google.com/',
            ]),
        ];
    }
}
