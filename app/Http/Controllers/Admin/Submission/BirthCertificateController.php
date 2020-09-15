<?php

namespace App\Http\Controllers\Admin\Submission;

use App\BirthCertificateSubmission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\enums\DocumentStatus;
use Yajra\DataTables\DataTables;
use App\Element\Button;

class BirthCertificateController extends Controller
{
    private $baseRouteName = "admin.submission.kk";

    public function datatable(Request $request)
    {
        $child = BirthCertificateSubmission::select('id', 'card_number', 'name')
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
}
