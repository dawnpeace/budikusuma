<?php

namespace App\Http\Controllers\Admin\Qualified;

use App\FamilyCardSubmission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\enums\DocumentStatus;
use Yajra\DataTables\DataTables;
use App\Element\Button;
use App\Exceptions\NaturalIdUsedExceptions;

class FamilyCardController extends Controller
{
    private $baseRouteName = 'admin.qualified.kk';

    public function index()
    {
        return view('admin.qualified.kk.index');
    }

    public function datatable(Request $request)
    {
        $users = FamilyCardSubmission::select('id', 'id_number', 'householder')
        ->where('status', DocumentStatus::DONE)
            ->where('published_at', null);

        return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return Button::checkButton(route($this->baseRouteName . '.edit', $row));
            })
            ->make(true);
    }

    public function edit(FamilyCardSubmission $card)
    {
        $redirectUrl = route($this->baseRouteName . '.index');
        $submitUrl = route($this->baseRouteName . '.update', $card);
        return view('admin.qualified.kk.edit', compact('card', 'redirectUrl', 'submitUrl'));
    }

    public function update(FamilyCardSubmission $card)
    {
        try {
            $card->publish();
            return response()->json();
        } catch (NaturalIdUsedExceptions $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
