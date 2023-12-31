<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogQueueHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_queue_headers', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string("display_name");
            $table->string("description");
            $table->string("payload_url");
            
            $table->unsignedBigInteger('log_queue_status_id');
            $table->foreign('log_queue_status_id')->references('id')->on('log_queue_statuses');
            $table->unsignedBigInteger('log_queue_priority_id');
            $table->foreign('log_queue_priority_id')->references('id')->on('log_queue_priorities');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_queue_headers');
    }
}
