<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogQueueHeader extends Model
{
    protected $table = "log_queue_headers";
    protected $guarded = [];
    public $incrementing = false;


    public function status()
    {
        return $this->belongsTo(LogQueueStatus::class, "log_queue_status_id");
    }

    public function priority()
    {
        return $this->belongsTo(LogQueuePriority::class, "log_queue_priority_id");
    }

    public function logQueueDetails()
    {
        return $this->hasMany(LogQueueDetail::class, "log_header_id");
    }
}
