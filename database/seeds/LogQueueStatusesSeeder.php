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
            ],
            [
                'status_name' => "processing",
            ],
            [
                'status_name' => "success",
            ],
            [
                'status_name' => "failed",
            ],
        ]);
    }
}
