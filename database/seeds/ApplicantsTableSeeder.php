<?php

use App\Applicant;
use Illuminate\Database\Seeder;

class ApplicantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        factory(Applicant::class, 600)->create();
    }
}
