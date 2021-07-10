<?php

namespace App\Http\Controllers\Admin\Submission;

use App\Http\Controllers\Controller;
use App\Rules\OptionalSize;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Element\Button;
use App\enums\DocumentStatus;
use App\enums\Religion;
use App\IdentityCardSubmission;
use App\Rules\EmptyOrNumericByStatus;
use Illuminate\Validation\Rule;

class IdentityCardController extends Controller
{

    private $baseRouteName = "admin.submission.ktp";

    public function datatable(Request $request)
    {
        $users = IdentityCardSubmission::select('id', 'id_card', 'name')
            ->where('status', '<>',DocumentStatus::DONE);

        if($request->has('status')){
            if (array_search($request->status, DocumentStatus::STATUS_NOT_DONE)) {
                $users = $users->where('status', $request->status);
            }
        }
        return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                return
                    Button::deleteButton(route($this->baseRouteName . '.delete', $row->id)).
                    Button::checkButton(route($this->baseRouteName . '.edit', $row->id));

            })
            ->make(true);
    }

    public function delete(IdentityCardSubmission $card)
    {
        $card->delete();
        return response()->json();
    }

    public function edit(IdentityCardSubmission $card)
    {
        $submitUrl = route($this->baseRouteName . '.update', $card);
        $redirectUrl = route($this->baseRouteName);
        $deleteUrl = route($this->baseRouteName . '.delete', $card);
        $media = $card->getFirstMedia();
        return view('admin.submission.ktp.edit', compact('submitUrl', 'card', 'redirectUrl', 'deleteUrl', 'media'));
    }

    public function update(IdentityCardSubmission $card, Request $request)
    {
        $request->validate([
            "id_card" => [
                Rule::requiredIf($request->status == DocumentStatus::DONE),
                new EmptyOrNumericByStatus($request),
                new OptionalSize(16)
            ],
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
            "nationality" => "required",
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
