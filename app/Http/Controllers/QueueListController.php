<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QueueListController extends Controller
{
    public function index(){
        return view("queue-list.index");
    }
}
