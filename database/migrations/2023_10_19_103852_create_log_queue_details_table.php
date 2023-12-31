<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogQueueDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_queue_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text("note");
            
            $table->string('log_header_id');
            $table->foreign('log_header_id')->references('id')->on('log_queue_headers');

            $table->unsignedBigInteger('log_queue_status_id');
            $table->foreign('log_queue_status_id')->references('id')->on('log_queue_statuses');

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
        Schema::dropIfExists('log_queue_details');
    }
}
