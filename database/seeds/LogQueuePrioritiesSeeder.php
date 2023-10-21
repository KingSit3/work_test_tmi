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
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                'priority_name' => "medium",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                'priority_name' => "high",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                'priority_name' => "emergency",
                "created_at" => now(),
                "updated_at" => now()
            ],
        ]);
    }
}
