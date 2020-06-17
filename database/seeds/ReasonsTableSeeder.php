<?php

use App\Reason;
use Illuminate\Database\Seeder;

class ReasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'title' => 'Screening Reject'],
            ['id' => 2, 'title' => 'Filtering Reject'],
            ['id' => 3, 'title' => 'Webinar Reject'],
            ['id' => 4, 'title' => 'App Onboard Reject'],
            ['id' => 5, 'title' => 'Failed Test'],
            ['id' => 6, 'title' => 'Training Dropout'],
            ['id' => 7, 'title' => 'Failed Exam'],
            ['id' => 8, 'title' => 'Failed Guaranteed'],
        ];

        foreach ($items as $item) {
            Reason::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
