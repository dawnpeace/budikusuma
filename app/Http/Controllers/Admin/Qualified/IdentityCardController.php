<?php

namespace App\Http\Controllers\Admin\Qualified;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\IdentityCardSubmission;
use App\enums\DocumentStatus;
use Yajra\DataTables\DataTables;
use App\Element\Button;
use App\Exceptions\NaturalIdUsedExceptions;

class IdentityCardController extends Controller
{

    private $baseRouteName = 'admin.qualified.ktp';

    public function index()
    {
        return view('admin.qualified.ktp.index');
    }

    public function datatable(Request $request)
    {
        $users = IdentityCardSubmission::select('id', 'id_card', 'name')
            ->where('status', DocumentStatus::DONE)
            ->where('published_at', null);

        return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return Button::checkButton(route($this->baseRouteName . '.edit', $row));
            })
            ->make(true);
    }

    public function edit(IdentityCardSubmission $card)
    {
        $redirectUrl = route($this->baseRouteName . '.index');
        $submitUrl = route($this->baseRouteName . '.update', $card);
        return view('admin.qualified.ktp.edit', compact('card', 'redirectUrl', 'submitUrl'));
    }

    public function update(IdentityCardSubmission $card)
    {
        try{
            $card->publish();
            return response()->json();
        } catch(NaturalIdUsedExceptions $e){
            return response()->json($e->getMessage(), 400);
        }
    }
}
