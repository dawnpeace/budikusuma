<?php

namespace App\Http\Controllers\Admin\Qualified;

use App\ChildIdSubmission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\enums\DocumentStatus;
use Yajra\DataTables\DataTables;
use App\Element\Button;
use App\Exceptions\NaturalIdUsedExceptions;

class ChildIdCardController extends Controller
{

    private $baseRouteName = 'admin.qualified.kia';

    public function index()
    {
        return view('admin.qualified.kia.index');
    }

    public function datatable(Request $request)
    {
        $users = ChildIdSubmission::select('id', 'card_number', 'name')
        ->where('status', DocumentStatus::DONE)
            ->where('published_at', null);

        return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return Button::checkButton(route($this->baseRouteName . '.edit', $row));
            })
            ->make(true);
    }

    public function edit(ChildIdSubmission $card)
    {
        $redirectUrl = route($this->baseRouteName . '.index');
        $submitUrl = route($this->baseRouteName . '.update', $card);
        $media = $card->getFirstMedia();
        return view('admin.qualified.kia.edit', compact('card', 'redirectUrl', 'submitUrl', 'media'));
    }

    public function update(ChildIdSubmission $card)
    {
        try {
            $card->publish();
            return response()->json();
        } catch (NaturalIdUsedExceptions $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
