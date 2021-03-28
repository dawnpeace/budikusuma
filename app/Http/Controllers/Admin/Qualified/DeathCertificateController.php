<?php

namespace App\Http\Controllers\Admin\Qualified;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Element\Button;
use App\enums\DocumentStatus;
use App\DeathCertificateSubmission;
use Yajra\DataTables\DataTables;
use App\Exceptions\NaturalIdUsedExceptions;


class DeathCertificateController extends Controller
{

    private $baseRouteName = 'admin.qualified.ak';

    public function index()
    {
        return view("admin.qualified.ak.index");
    }

    public function datatable(Request $request)
    {
        $users = DeathCertificateSubmission::select('id', 'card_number', 'name')
        ->where('status', DocumentStatus::DONE)
            ->where('published_at', null);

        return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return Button::checkButton(route($this->baseRouteName . '.edit', $row));
            })
            ->make(true);
    }

    public function edit(DeathCertificateSubmission $card)
    {
        $redirectUrl = route($this->baseRouteName . '.index');
        $submitUrl = route($this->baseRouteName . '.update', $card);
        return view('admin.qualified.ak.edit', compact('card', 'redirectUrl', 'submitUrl'));
    }

    public function update(DeathCertificateSubmission $card)
    {
        try {
            $card->publish();
            return response()->json();
        } catch (NaturalIdUsedExceptions $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
