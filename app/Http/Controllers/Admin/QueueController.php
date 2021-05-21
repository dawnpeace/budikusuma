<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\QueueRequest;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class QueueController extends Controller
{
    public function datatable() {
        $queue = QueueRequest::with("user")->whereDate('appointed_at', '>=', Carbon::now());
        return DataTables::eloquent($queue)->toJson();
    }
}
