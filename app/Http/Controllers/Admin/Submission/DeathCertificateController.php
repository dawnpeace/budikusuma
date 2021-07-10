<?php

namespace App\Http\Controllers\Admin\Submission;

use App\DeathCertificateSubmission;
use App\Element\Button;
use App\enums\DocumentStatus;
use App\Http\Controllers\Controller;
use App\Rules\EmptyOrNumericByStatus;
use App\Rules\OptionalSize;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\Rule;

class DeathCertificateController extends Controller
{

    private $baseRouteName = "admin.submission.ak";

    public function datatable(Request $request)
    {
        $child = DeathCertificateSubmission::select('id', 'card_number', 'name')
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

    public function edit(DeathCertificateSubmission $card)
    {
        $submitUrl = route($this->baseRouteName . '.update', $card);
        $redirectUrl = route($this->baseRouteName);
        $deleteUrl = route($this->baseRouteName . '.delete', $card);
        $media = $card->getFirstMedia();
        return view('admin.submission.ak.edit', compact('submitUrl', 'card', 'redirectUrl', 'deleteUrl', 'media'));
    }

    public function update(Request $request, DeathCertificateSubmission $card) {
        $request->validate([
            "status" => [
                "required",
                Rule::in(DocumentStatus::ALL)
            ],
            "birthdate" => "required|date_format:d-m-Y",
            "deceased_at" => "required|date_format:d-m-Y",
            "birthplace" => "required",
            "name" => "required",
            "note" => "required",
            "card_number" => [
                "required_if:status,04",
                new EmptyOrNumericByStatus($request),
                new OptionalSize(16)
            ],
            "identity_card" => "required",
            "reason" => Rule::requiredIf($request->status == DocumentStatus::REJECTED)
        ]);

        $card->update($request->all());
        return response()->json();
    }

    public function delete(DeathCertificateSubmission $card) {
        $card->delete();
        return response()->json();
    }
}
