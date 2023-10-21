<?php

namespace App\Traits;

use App\LogQueueDetail;
use App\LogQueueHeader;
use App\LogQueuePriority;
use App\LogQueueStatus;
use Exception;

trait LogQueueTrait
{
  public function InitQueueLog($displayName, $description, $priority, $payload)
  {

    // Get Priority
    $priority = LogQueuePriority::select("id")->find("priority_name", $priority)->first();
    if (!$priority) {
      throw "Can't get priority id";
    }
    // End Get Priority

    // Get Status ID
    $status = LogQueueStatus::select("id")->find("status_name", "waiting")->first();
    if (!$status) {
      throw "Can't get status id";
    }
    // End Get Status ID

    $logQueueHeader = LogQueueHeader::create([
      "display_name" => $displayName,
      "description" => $description,
      "priority_id" => $priority->id,
      "status_id" => $status
    ]);

    LogQueueDetail::create([
      "note" => "New Queue appeared!",
      "lod_header_id" => $logQueueHeader->id,
      "status_id" => $status
    ]);
  }
}
