<?php

namespace App\Http\Controllers;

use App\Jobs;
use Illuminate\Http\Request;

class GetAllQueueController extends Controller
{
    public function GetAll() {
        $jobs = Jobs::get();

        return response(["queue_count" => $jobs->count(), "data" => $jobs]);
    }
}
