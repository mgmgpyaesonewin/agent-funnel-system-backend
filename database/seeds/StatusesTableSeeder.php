<?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'title' => 'Pending'],
            ['id' => 2, 'title' => 'Screened'],
            ['id' => 3, 'title' => 'Filtered'],
            ['id' => 4, 'title' => 'Invited'],
            ['id' => 5, 'title' => 'Accept Webinar'],
            ['id' => 6, 'title' => 'Request Reschedule'],
            ['id' => 7, 'title' => 'No Show'],
            ['id' => 8, 'title' => 'Onboarded'],
            ['id' => 9, 'title' => 'Approved'],
            ['id' => 10, 'title' => 'Qualified'],
            ['id' => 11, 'title' => 'Certified'],
            ['id' => 12, 'title' => 'Rejected'],
        ];

        foreach ($items as $item) {
            Status::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
