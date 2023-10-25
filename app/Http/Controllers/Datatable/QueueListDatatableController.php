<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use App\LogQueueHeader;
use Illuminate\Http\Request;
use DataTables;

class QueueListDatatableController extends Controller
{
    public function index(){
        $logQueueList = LogQueueHeader::query()->with(["status", "priority", "logQueueDetails.status"]);

        return DataTables::of($logQueueList)
                        ->addIndexColumn()
                        ->orderColumn('updated_at', '-updated_at $1')
                        ->orderColumn('display_name', '-display_name $1')
                        ->editColumn('payload_url', function($row){
                            return "<a href=". $row["payload_url"] ." target='_blank'>Lihat payload</a>";
                        })
                        ->rawColumns(["payload_url"])
                        ->toJson();
    }
}
