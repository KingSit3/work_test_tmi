<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogQueueDetail extends Model
{
    protected $table = "log_queue_details";
    protected $guarded = [];

    public function status()
    {
        return $this->belongsTo(LogQueueStatus::class, "log_queue_status_id");
    }
}
