<?php

namespace App\Http\Controllers\Admin\Submission;

use App\Http\Controllers\Controller;
use App\Rules\OptionalSize;
use Illuminate\Http\Request;
use App\FamilyCardSubmission;
use App\enums\DocumentStatus;
use App\Element\Button;
use App\enums\Gender;
use App\enums\Religion;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Rules\EmptyOrNumericByStatus;

class FamilyCardController extends Controller
{
    private $baseRouteName = "admin.submission.kk";

    public function datatable(Request $request)
    {
        $certi = FamilyCardSubmission::select('id', 'id_number', 'householder')
        ->where('status', '<>', DocumentStatus::DONE);

        if ($request->has('status')) {
            if (array_search($request->status, DocumentStatus::STATUS_NOT_DONE)) {
                $child = $certi->where('status', $request->status);
            }
        }

        return Datatables::of($certi)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return
                    Button::deleteButton(route($this->baseRouteName . '.delete', $row->id)) .
                    Button::checkButton(route($this->baseRouteName . '.edit', $row->id));
            })
            ->make(true);
    }

    public function edit(FamilyCardSubmission $card)
    {
        $card->load('members');
        $submitUrl = route($this->baseRouteName . '.update', $card);
        $redirectUrl = route($this->baseRouteName);
        $deleteUrl = route($this->baseRouteName . '.delete', $card);
        $media = $card->getFirstMedia();
        return view('admin.submission.kk.edit', compact('submitUrl', 'card', 'redirectUrl', 'deleteUrl', 'media'));
    }

    public function update(FamilyCardSubmission $card, Request $request)
    {
        $request->validate($this->getRule($request), ['id_number.required_if' => 'Id number can not be empty when status is set to Done.']);
        $famCardRequest = $request->only([
            "householder_name", "householder_id_card", "address", "rt", "rw", "zipcode",
            "kelurahan", "kecamatan", "kabupaten", "provinsi", "members", "status", "id_number", "reason"
        ]);

        DB::transaction(function() use ($famCardRequest, $request, $card) {
            $card->update($famCardRequest);
            if ($request->has('members')) {
                foreach($request->get('members') as $req){
                    $collection = new Collection($req);
                    $collection = $collection->only([
                        'name', 'id_card', 'gender', 'birthplace', 'birthdate', 'religion', 'education', 'profession',
                        'family_relation', 'status', 'id'
                    ]);

                    $collection['birthdate'] = Carbon::createFromFormat('d-m-Y', $collection->get('birthdate'))->format('Y-m-d');

                    if ( !$collection->isEmpty('id') ) {
                        $card->members()
                            ->where('id', $collection->get('id'))
                            ->update($collection->toArray());
                    }
                }
            }
        });
    }

    public function delete(FamilyCardSubmission $card)
    {
        return $card->delete();
    }

    private function getRule(Request $request)
    {
        return [
            "id_number" => [
                "required_if:status,04",
                new EmptyOrNumericByStatus($request),
                new OptionalSize(16)
            ],
            "householder" => "required",
            "householder_id_card" => "required|numeric",
            "address" => "required",
            "rt" => "required",
            "rw" => "required",
            "zipcode" => "required",
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
            "status" => [
                "required",
                Rule::in(DocumentStatus::ALL)
            ],
            "reason" => Rule::requiredIf($request->status == DocumentStatus::REJECTED)
        ];
    }
}
