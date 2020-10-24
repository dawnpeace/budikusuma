<?php

namespace App\Http\Controllers\Admin\Stored;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ChildIdentityCard;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Element\Button;
use Illuminate\Validation\Rule;
use App\enums\Gender;
use App\Exports\ChildIdentityCardExport;
use App\enums\DocumentStatus;
use App\enums\Religion;

class ChildIdController extends Controller
{
    private $baseRouteName = "admin.stored.kia";

    public function index()
    {
        $latestDate = ChildIdentityCard::getLatestRecord();
        $oldestDate = ChildIdentityCard::getOldestRecord();
        $exportUrl = route($this->baseRouteName . '.export');
        $ajaxUrl = route($this->baseRouteName . '.datatable');
        return view('admin.stored.kia.index', compact('latestDate', 'oldestDate', 'ajaxUrl', 'exportUrl'));
    }

    public function datatable(Request $request)
    {

        $card = ChildIdentityCard::select('id', 'card_number', 'name', 'created_at');

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

    public function edit(ChildIdentityCard $card)
    {
        $submitUrl = route($this->baseRouteName . '.update', $card);
        $redirectUrl = route($this->baseRouteName . '.index');
        return view('admin.stored.kia.edit', compact(['card', 'redirectUrl', 'submitUrl']));
    }

    public function update(ChildIdentityCard $card, Request $request)
    {
        $request->validate([
            "card_number" => [
                "require",
                "unique:App\ChildIdentityCard,card_number," . $card->card_number,
            ],
            "name" => "required",
            "gender" => [
                "required", Rule::in(Gender::ALL)
            ],
            "card_number" => [
                Rule::requiredIf($request->status == DocumentStatus::DONE),
            ],
            "address" => "required",
            "birthdate" => "required|date_format:d-m-Y",
            "birthplace" => "required",
            "family_card_number" => "required|numeric",
            "householder_name" => "required",
            "birth_certificate_number" => "required|numeric",
            "citizenship" => "required",
            "rt" => "required|numeric",
            "rw" => "required|numeric",
            "kelurahan" => "required",
            "kecamatan" => "required",
            "religion" => [
                "required",
                Rule::in(Religion::ALL)
            ],
            "status" => [
                "required",
                Rule::in(DocumentStatus::ALL)
            ]
        ]);
        $card->update($request->all());
    }

    public function export(Request $request)
    {
        return (new ChildIdentityCardExport($request->start_date, $request->end_date))->download('rekap.xlsx');
    }
}
