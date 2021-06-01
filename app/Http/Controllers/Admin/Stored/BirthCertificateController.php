<?php

namespace App\Http\Controllers\Admin\Stored;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BirthCertificate;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Element\Button;
use App\Exports\BirthCertificateExport;
use Illuminate\Validation\Rule;
use App\enums\Gender;

class BirthCertificateController extends Controller
{
    private $baseRouteName = "admin.stored.al";

    public function index()
    {
        $latestDate = BirthCertificate::getLatestRecord();
        $oldestDate = BirthCertificate::getOldestRecord();
        $exportUrl = route($this->baseRouteName . '.export');
        $ajaxUrl = route($this->baseRouteName . '.datatable');
        return view('admin.stored.al.index', compact('latestDate', 'oldestDate', 'ajaxUrl', 'exportUrl'));
    }

    public function datatable(Request $request)
    {

        $card = BirthCertificate::select('id', 'id_card', 'name', 'created_at');

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

    public function edit(BirthCertificate $card)
    {
        $submitUrl = route($this->baseRouteName . '.update', $card);
        $redirectUrl = route($this->baseRouteName . '.index');
        $media = $card->getFirstMedia();
        return view('admin.stored.al.edit', compact(['card', 'redirectUrl', 'submitUrl', 'media']));
    }

    public function update(BirthCertificate $card, Request $request)
    {
        $request->validate([
            "name" => "required",
            "gender" => [
                "required",
                Rule::in(Gender::ALL)
            ],
            "birthdate" => "required|date|date_format:d-m-Y",
            "birthplace" => "required",
            "mother_identity_card_number" => "required|numeric",
            "mother_name" => "required",
            "father_identity_card_number" => "required|numeric",
            "father_name" => "required",
        ]);
        $card->update($request->all());
    }

    public function export(Request $request)
    {
        return (new BirthCertificateExport($request->start_date, $request->end_date))->download('rekap.xlsx');
    }
}
