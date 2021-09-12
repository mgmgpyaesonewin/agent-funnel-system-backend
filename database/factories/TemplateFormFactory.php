<?php

namespace Database\Factories;

use App\Models\TemplateForm;
use Illuminate\Database\Eloquent\Factories\Factory;

class TemplateFormFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TemplateForm::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'template_name' => 'Template Title',
            'preferred_name' => 1,
            'name' => 1,
            'nrc' => 1,
            'nrc_photo' => 1,
            'dob' => 1,
            'gender' => 1,
            'myanmar_citizen' => 1,
            'citizenship' => 1,
            'race' => 1,
            'marital_status' => 1,
            'address' => 1,
            'city' => 1,
            'township' => 1,
            'contact_no' => 1,
            'alternate_no' => 1,
            'highest_qualification' => 1,
            'email' => 1,
            'conflict_interest' => 1,
            'term_condition' => 1,
            'additional_info' => []
        ];
    }
}
