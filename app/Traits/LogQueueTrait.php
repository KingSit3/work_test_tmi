<?php

namespace App\Traits;

use App\LogQueueDetail;
use App\LogQueueHeader;
use App\LogQueuePriority;
use App\LogQueueStatus;
use Illuminate\Support\Facades\Storage;

trait LogQueueTrait
{
  public function InitQueueLog($displayName, $jobId, $description, $priority, $payload)
  {
    // Get Priority
    $priority = LogQueuePriority::where("priority_name", $priority)->firstOrFail();
    // End Get Priority

    // Get Status ID
    $status = LogQueueStatus::where("status_name", "waiting")->firstOrFail();
    // End Get Status ID

    // Save to S3
    Storage::put("queue_log/log-queue-".$jobId.".json", json_encode($payload));
    // End Save to S3

    $logQueueHeader = LogQueueHeader::create([
      "id" => $jobId,
      "display_name" => $displayName,
      "description" => $description,
      "priority_id" => $priority->id,
      "status_id" => $status->id,

      "payload_url" => $jobId
    ]);

    LogQueueDetail::create([
      "note" => "New Queue appeared!",
      "log_header_id" => $logQueueHeader->id,
      "status_id" => $status->id
    ]);
  }

  public function UpdateQueueLogStatus($status, $jobId, $note)
  {
    // Get Status ID
    $status = LogQueueStatus::where("status_name", $status)->firstOrFail();
    // End Get Status ID

    LogQueueHeader::findOrFail($jobId)->update([
      "status_id" => $status->id,
    ]);

    LogQueueDetail::create([
      "note" => $note,
      "log_header_id" => $jobId,
      "status_id" => $status->id
    ]);
  }
}
