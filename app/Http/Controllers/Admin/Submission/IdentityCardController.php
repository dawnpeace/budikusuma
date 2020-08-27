<?php

namespace App\Http\Controllers\Admin\Submission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Element\Button;
use App\enums\DocumentStatus;
use App\IdentityCardSubmission;
use Illuminate\Support\Arr;

class IdentityCardController extends Controller
{
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
                    Button::deleteButton(route($this->getUrlBasePath('delete'), $row->id)).
                    Button::checkButton(route($this->getUrlBasePath('edit'), $row->id));
                
            })
            ->make(true);
    }

    public function delete(IdentityCardSubmission $card)
    {

    }

    public function edit(IdentityCardSubmission $card)
    {

    }

    private function getUrlBasePath($string = '')
    {
        return 'admin.submission.ktp.' . $string; 
    }

}
