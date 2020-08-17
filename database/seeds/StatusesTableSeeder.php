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
            ['id' => 1, 'title' => 'New'],
            ['id' => 2, 'title' => 'Inconsideration'],
            ['id' => 3, 'title' => 'Accepted'],
            ['id' => 4, 'title' => 'Rejected'],
            ['id' => 5, 'title' => 'Passed'],
            ['id' => 6, 'title' => 'Interview Sent'],
            ['id' => 7, 'title' => 'Invalid Info'],
        ];

        foreach ($items as $item) {
            Status::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
