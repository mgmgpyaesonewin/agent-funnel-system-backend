<?php

namespace Database\Factories;

use App\Models\Contract;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contract::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pdf' => 'contracts/09780003637-09_10_20_12_10_12.pdf',
            'signed_date' => $this->faker->dateTime(),
            'applicant_sign_img' => 'sign/applicant/5mDbHXncV5cRgZnbrj1VgYKYXiLsLdbLvGWVMq6T.png',
            'witness_name' => $this->faker->name,
            'witness_sign_img' => 'sign/witness/5aQILYlesBGcUvk3txDccJCyIGZHspcwvk9jc3PO.png',
            'version' => 1
        ];
    }
}
