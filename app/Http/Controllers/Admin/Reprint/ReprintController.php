<?php

namespace App\Http\Controllers\Admin\Reprint;

use App\BirthCertificate;
use App\ChildIdentityCard;
use App\enums\Document;
use App\FamilyCard;
use App\Http\Controllers\Controller;
use App\IdentityCard;
use App\ReprintRequest;
use Illuminate\Http\Request;
use App\Element\Button;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class ReprintController extends Controller
{

    private $baseRouteName = "admin.reprint";

    public function index()
    {
        return view('admin.reprint.index');
    }

    public function datatable(Request $request)
    {
        $reprintableType = IdentityCard::getClassName();

        if($request->has('document')) {
            if (array_search($request->document, Document::ALL)) {
                switch($request->document) {
                    case Document::KTP:
                        $reprintableType = IdentityCard::getClassName();
                        break;
                    case Document::KIA;
                        $reprintableType = ChildIdentityCard::getClassName();
                        break;
                    case Document::KK;
                        $reprintableType = FamilyCard::getClassName();
                        break;
                    case Document::AKTA_LAHIR:
                        $reprintableType = BirthCertificate::getClassName();
                        break;
                }
            }
        }
        $reprintRequests = ReprintRequest::select("id", "id_number", "created_at", "printed_at")
            ->where("reprintable_type", $reprintableType);
        
        return DataTables::of($reprintRequests)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return
                    Button::deleteButton(route($this->baseRouteName . '.destroy', $row->id)) .
                    Button::checkButton(route($this->baseRouteName . '.edit', $row->id));
            })
            ->make(true);
    }

    public function edit(ReprintRequest $reprint, Request $request)
    {
        $reprint->load('reprintable');
        $deleteUrl = route($this->baseRouteName . '.destroy', $reprint);
        $redirectUrl = route($this->baseRouteName . '.index');
        $submitUrl = route($this->baseRouteName . '.submit' ,$reprint);
        $document = $reprint;
        return view('admin.reprint.edit', compact(['deleteUrl', 'redirectUrl', 'document', 'submitUrl']));
    }

    public function destroy(ReprintRequest $reprint)
    {
        // $reprint->delete();
    }

    public function markAsPrinted(ReprintRequest $reprint, Request $request)
    {
        $request->validate([
            "printed_at" => "required|date|date_format:d-m-Y"
        ]);

        if ( !$reprint->isPrinted() ) {
            $reprint->printed_at = Carbon::createFromFormat('d-m-Y', $request->printed_at);
            $reprint->save();
            return response()->json();
        } 

        return response()->json([
            "message" => "Data telah dicetak"
        ], 400);
    }
}
