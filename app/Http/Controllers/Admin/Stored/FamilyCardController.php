<?php

namespace App\Http\Controllers\Admin\Stored;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;
use App\Element\Button;
use App\Exports\FamilyCardExport;
use App\FamilyCard;
use App\enums\Gender;
use App\enums\Religion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class FamilyCardController extends Controller
{

    private $baseRouteName = "admin.stored.kk";

    public function index()
    {
        $latestDate = FamilyCard::getLatestRecord();
        $oldestDate = FamilyCard::getOldestRecord();
        $exportUrl = route($this->baseRouteName . '.export');
        $ajaxUrl = route($this->baseRouteName . '.datatable');
        return view('admin.stored.kk.index', compact('latestDate', 'oldestDate', 'ajaxUrl', 'exportUrl'));
    }

    public function datatable(Request $request)
    {
        $card = FamilyCard::select('id', 'id_card', 'householder', 'created_at');

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

    public function edit(FamilyCard $card)
    {
        $card->load('members');
        $submitUrl = route($this->baseRouteName . '.update', $card);
        $redirectUrl = route($this->baseRouteName . '.index');
        return view('admin.stored.kk.edit', compact(['card', 'redirectUrl', 'submitUrl']));
    }

    public function update(FamilyCard $card, Request $request)
    {
        $request->validate($this->getRule());
        $famCardRequest = $request->only([
            "householder_name", "householder_id_card", "address", "rt", "rw", "zipcode",
            "kelurahan", "kecamatan", "kabupaten", "provinsi", "members", "status", "id_card"
        ]);
        DB::transaction(function () use ($famCardRequest, $request, $card) {
            $card->update($famCardRequest);
            if ($request->has('members')) {
                foreach ($request->get('members') as $req) {
                    $collection = new Collection($req);
                    $collection = $collection->only([
                        'name', 'id_card', 'gender', 'birthplace', 'birthdate', 'religion', 'education', 'profession',
                        'family_relation', 'status', 'id'
                    ]);

                    $collection['birthdate'] = Carbon::createFromFormat('d-m-Y', $collection->get('birthdate'))->format('Y-m-d');

                    if (!$collection->isEmpty('id')) {
                        $card->members()
                            ->where('id', $collection->get('id'))
                            ->update($collection->toArray());
                    }
                }
            }
        });
    }

    public function export(Request $request)
    {
        return (new FamilyCardExport($request->start_date, $request->end_date))->download('rekap.xlsx');
    }

    private function getRule()
    {
        return [
            "householder" => "required",
            "householder_id_card" => "required|numeric",
            "address" => "required",
            "id_card" => "required",
            "rt" => "required",
            "rw" => "required",
            "zip_code" => "required",
            "kelurahan" => "required",
            "kecamatan" => "required",
            "kabupaten" => "required",
            "provinsi" => "required",
            "members" => "required|array",
            "members.*.name" => "required",
            "members.*.gender" => [
                "required",
                Rule::in(Gender::ALL)
            ],
            "members.*.id_card" => "required|numeric",
            "members.*.birthdate" => "required|date|date_format:d-m-Y",
            "members.*.birthplace" => "required",
            "members.*.religion" => [
                "required",
                Rule::in(Religion::ALL)
            ],
            "members.*.education" => "required",
            "members.*.profession" => "required",
            "members.*.family_relation" => "required",
        ];
    }
}
