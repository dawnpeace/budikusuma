<?php

namespace App\Http\Controllers\Admin\Submission;

use App\BirthCertificateSubmission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\enums\DocumentStatus;
use Yajra\DataTables\DataTables;
use App\Element\Button;
use Illuminate\Validation\Rule;
use App\enums\Gender;

class BirthCertificateController extends Controller
{
    private $baseRouteName = "admin.submission.al";

    public function datatable(Request $request)
    {
        $child = BirthCertificateSubmission::select('id', 'id_card', 'name')
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

    public function edit(BirthCertificateSubmission $card)
    {
        $submitUrl = route($this->baseRouteName . '.update', $card);
        $redirectUrl = route($this->baseRouteName);
        $deleteUrl = route($this->baseRouteName . '.delete', $card);
        return view('admin.submission.al.edit', compact('submitUrl', 'card', 'redirectUrl', 'deleteUrl'));
    }

    public function update(BirthCertificateSubmission $card, Request $request)
    {
        $request->validate([
            "id_card" => "required_if:status," . DocumentStatus::DONE,
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
            "status" => [
                "required",
                Rule::in(DocumentStatus::ALL)
            ],
            "reason" => Rule::requiredIf($request->status == DocumentStatus::REJECTED)
        ]);

        $card->update($request->all());
    }

    public function delete(BirthCertificateSubmission $card)
    {
        $card->delete();
    }
}
