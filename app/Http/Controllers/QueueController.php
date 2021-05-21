<?php

namespace App\Http\Controllers;

use App\enums\Document;
use Illuminate\Http\Request;
use App\QueueRequest;
use App\Rules\QueueExists;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class QueueController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $queues = QueueRequest::where('user_id', $id)
            ->whereDate('appointed_at', '>=', Carbon::now())
            ->get();

        return view('queue.index', compact(['queues']));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'appointed_at' => [
                'date', 'date_format:d-m-Y', 'after_or_equal:today'
            ],
            'note' => 'required',
            'document' => [
                'required', Rule::in(Document::ALL), new QueueExists
            ]
        ]);
        
        $validated['user_id'] = Auth::id();
        
        QueueRequest::create($validated);
        return response()->json([], 201);
    }

    public function destroy(QueueRequest $queue)
    {
        $queue->delete();
        return response()->json([],200);
    }
}
