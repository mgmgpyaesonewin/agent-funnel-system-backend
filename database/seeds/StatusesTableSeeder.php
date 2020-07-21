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
        ];

        foreach ($items as $item) {
            Status::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
