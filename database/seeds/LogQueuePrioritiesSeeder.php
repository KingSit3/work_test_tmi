<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogQueuePrioritiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('log_queue_priorities')->insert([
            [
                'priority_name' => "low",
            ],
            [
                'priority_name' => "medium",
            ],
            [
                'priority_name' => "high",
            ],
            [
                'priority_name' => "emergency",
            ],
        ]);
    }
}
