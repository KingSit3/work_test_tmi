<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogQueueStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('log_queue_statuses')->insert([
            [
                'status_name' => "waiting",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                'status_name' => "processing",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                'status_name' => "success",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                'status_name' => "failed",
                "created_at" => now(),
                "updated_at" => now()
            ],
        ]);
    }
}
