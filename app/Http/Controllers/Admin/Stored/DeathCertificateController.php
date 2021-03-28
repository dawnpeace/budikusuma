<?php

namespace App\Http\Controllers\Admin\Stored;

use App\DeathCertificate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Element\Button;
use App\enums\Gender;
use App\Exports\DeathCertificateExport;
use Illuminate\Validation\Rule;

class DeathCertificateController extends Controller
{
    private $baseRouteName = "admin.stored.ak";

    public function index()
    {
        $latestDate = DeathCertificate::getLatestRecord();
        $oldestDate = DeathCertificate::getOldestRecord();
        $exportUrl = route($this->baseRouteName . '.export');
        $ajaxUrl = route($this->baseRouteName . '.datatable');
        return view('admin.stored.ak.index', compact('latestDate', 'oldestDate', 'ajaxUrl', 'exportUrl'));
    }

    public function datatable(Request $request)
    {

        $card = DeathCertificate::select('id', 'card_number', 'name', 'created_at');

        if ($request->has('start_date') && $request->has('end_date')) {
            $rules = [
                "start_date" => "date|date_format:Y-m-d",
                "end_date" => "date|date_format:Y-m-d"
            ];
            $validator = Validator::make(
                $request->only(['start_date', 'end_date']),
                $rules
            );

            if (!$validator->fails()) {
                $card->whereRaw("DATE(created_at) BETWEEN ? AND ?", [$request->start_date, $request->end_date]);
            }
        }

        return DataTables::of($card)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return Button::checkButton(route($this->baseRouteName . '.edit', $row));
            })
            ->make(true);
    }

    public function edit(DeathCertificate $card)
    {
        $submitUrl = route($this->baseRouteName . '.update', $card);
        $redirectUrl = route($this->baseRouteName . '.index');
        return view('admin.stored.ak.edit', compact(['card', 'redirectUrl', 'submitUrl']));
    }

    public function update(DeathCertificate $card, Request $request)
    {
        $request->validate([
            "name" => "required",
            "gender" => [
                "required",
                Rule::in(Gender::ALL)
            ],
            "birthdate" => "required|date|date_format:d-m-Y",
            "birthplace" => "required",
            "deceased_at" => "required|date|date_format:d-m-Y",
            "note" => "required"
        ]);
        $card->update($request->all());
    }

    public function export(Request $request)
    {
        return (new DeathCertificateExport($request->start_date, $request->end_date))->download('rekap.xlsx');
    }
}
