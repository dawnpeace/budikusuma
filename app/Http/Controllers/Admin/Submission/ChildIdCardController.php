<?php

namespace App\Http\Controllers\Admin\Submission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ChildIdSubmission;
use App\enums\DocumentStatus;
use Yajra\Datatables\Datatables;
use App\Element\Button;
use App\enums\Gender;
use App\enums\Religion;
use Illuminate\Validation\Rule;
use App\Rules\EmptyOrNumericByStatus;


class ChildIdCardController extends Controller
{

    private $baseRouteName = "admin.submission.kia";

    public function datatable(Request $request)
    {
        $child = ChildIdSubmission::select('id', 'card_number', 'name')
            ->where('status', '<>', DocumentStatus::DONE);

        if ($request->has('status')) {
            if (array_search($request->status, DocumentStatus::STATUS_NOT_DONE)) {
                $child = $child->where('status', $request->status);
            }
        }

        return Datatables::of($child)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return
                    Button::deleteButton(route($this->baseRouteName . '.delete', $row->id)) .
                    Button::checkButton(route($this->baseRouteName . '.edit', $row->id));
            })
            ->make(true);

    }

    public function edit(ChildIdSubmission $card)
    {
        $submitUrl = route($this->baseRouteName . '.update', $card);
        $redirectUrl = route($this->baseRouteName);
        $deleteUrl = route($this->baseRouteName . '.delete', $card);
        return view('admin.submission.kia.edit', compact('submitUrl', 'card', 'redirectUrl', 'deleteUrl'));
    }

    public function delete(ChildIdSubmission $card)
    {
        $card->delete();
    }

    public function update(Request $request, ChildIdSubmission $card)
    {
        $request->validate([
            "name" => "required",
            "gender" => [
                "required", Rule::in(Gender::ALL)
            ],
            "card_number" => [
                Rule::requiredIf($request->status == DocumentStatus::DONE),
                new EmptyOrNumericByStatus($request),
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
            ],
            "reason" => Rule::requiredIf($request->status == DocumentStatus::REJECTED)

        ]);
        $card->update($request->all());
        return response()->json();
    }
}
