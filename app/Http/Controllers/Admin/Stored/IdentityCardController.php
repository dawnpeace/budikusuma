<?php

namespace App\Http\Controllers\Admin\Stored;

use App\Element\Button;
use App\enums\Religion;
use App\Exports\IdentityCardExport;
use App\Http\Controllers\Controller;
use App\IdentityCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;

class IdentityCardController extends Controller
{

    private $baseRouteName = "admin.stored.ktp";

    public function index()
    {
        $latestDate = IdentityCard::getLatestRecord();
        $oldestDate = IdentityCard::getOldestRecord();
        $exportUrl = route($this->baseRouteName . '.export');
        $ajaxUrl = route($this->baseRouteName . '.datatable');
        return view('admin.stored.ktp.index', compact('latestDate', 'oldestDate', 'ajaxUrl', 'exportUrl'));
    }

    public function datatable(Request $request)
    {
        $card = IdentityCard::select('id', 'identity_card_number', 'name', 'created_at');

        if( $request->has('start_date') && $request->has('end_date') ) {
            $rules = [
                "start_date" => "date|date_format:Y-m-d",
                "end_date" => "date|date_format:Y-m-d"
            ];
            $validator = Validator::make(
                $request->only(['start_date', 'end_date']),
                $rules
            );

            if( !$validator->fails() ) {
                $card->whereRaw("DATE(created_at) BETWEEN ? AND ?", [$request->start_date, $request->end_date]);
            }
        }

        return DataTables::of($card)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                return Button::checkButton(route($this->baseRouteName . '.edit', $row));
            })
            ->make(true);
    }

    public function edit(IdentityCard $card)
    {
        $submitUrl = route($this->baseRouteName . '.update', $card);
        $redirectUrl = route($this->baseRouteName . '.index');
        $media = $card->getFirstMedia();
        return view('admin.stored.ktp.edit', compact(['card' ,'redirectUrl', 'submitUrl', 'media']));
    }

    public function update(IdentityCard $card, Request $request)
    {
        $request->validate([
            "identity_card_number" => 'required|numeric',
            "name" => "required",
            "gender" => [
                "required",
                Rule::in(["laki-laki", "perempuan"])
            ],
            "address" => "required",
            "birthplace" => "required",
            "birthdate" => "required|date_format:d-m-Y",
            "rt" => "required|numeric",
            "rw" => "required|numeric",
            "kelurahan" => "required",
            "kecamatan" => "required",
            "profession" => "required",
            "religion" => [
                "required",
                Rule::in(Religion::ALL)
            ],
            "marriage_status" => [
                "required",
                Rule::in(["not_married", "married", "widowed"])
            ],
            "nationality" => "required"
        ]);

        $card->update($request->all());
    }

    public function export(Request $request)
    {
        return (new IdentityCardExport($request->start_date, $request->end_date))->download('rekap.xlsx');
    }
}
