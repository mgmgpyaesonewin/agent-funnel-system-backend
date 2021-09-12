<?php

namespace Database\Factories;

use App\Models\Applicant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ApplicantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Applicant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'preferred_name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'secondary_phone' => $this->faker->phoneNumber,
            'dob' => $this->faker->dateTimeBetween('-30 years', '-18 years'),
            'uuid' => (string) Str::uuid(),
            'gender' => $this->faker->numberBetween(0, 1),
            'nrc' => $this->faker->numerify('12/SaKhaNa(N)######'),
            'current_status' => 'pre_filter',
            'email' => $this->faker->freeEmail,
            'address' => $this->faker->address,
            'education' => $this->faker->randomElement([
                'Primary Education',
                'Secondary Education',
                'Matriculation',
                'Graduate',
                'Post Graduate',
                'Diploma or equivalent',
            ]),
            'race' => $this->faker->randomElement([
                'Kachin',
                'Kayah',
                'Kayin',
                'Chin',
                'Burma',
                'Mon',
                'Rakhine',
                'Shan',
            ]),
            'myanmar_citizen' => $this->faker->numberBetween(0, 1),
            'citizen' => $this->faker->country,
            'married' => $this->faker->randomElement(['Single', 'Married', 'Divorced', 'Widowed']),
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
                'address' => $this->faker->address,
                'position' => $this->faker->jobTitle,
            ]),
            'family_agent' => json_encode([
                'name' => $this->faker->name,
                'position' => $this->faker->jobTitle,
                'agent_code' => 'AA-1001',
                'relation' => 'wife',
                'nrc' => '12/SaKaNa(N)082719',
            ]),
            'status_id' => 1,
            'city_id' => 2,
            'township_id' => 2,
            'spouse_name' => $this->faker->name,
            'spouse_nrc' => $this->faker->numerify('12/SaKhaNa(N)######'),
            'bank_account_name' => $this->faker->name,
            'bank_account_no' => $this->faker->numerify('###-###-###-##'),
            'banK_name' => 'CO-OPERATIVE BANK (CB BANK)',
            'swift_code' => 'CPOBMMMY',
            'license_no' => $this->faker->numerify('###-###-###'),
        ];
    }
}
