<?php

namespace App\Http\Controllers\Check;

use App\BirthCertificateSubmission;
use App\ChildIdSubmission;
use App\DeathCertificateSubmission;
use App\enums\Document;
use App\FamilyCardSubmission;
use App\Http\Controllers\Controller;
use App\IdentityCardSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        return view('check-submission.index');
    }

    public function submit(Request $request)
    {
        if(!$request->has('document')){
            return response()->json([
                "message" => "Please set the document type"
            ], 400);
        }

        switch($request->document){
            case Document::KTP:
                return $this->identityCard();
            case Document::AKTA_LAHIR:
                return $this->birthCertificate();
            case Document::KIA:
                return $this->childIdCard();
            case Document::KK:
                return $this->familyCard();
            case Document::AKTA_KEMATIAN:
                return $this->deathCertificate();
        }
    }

    private function identityCard()
    {
        $documents = IdentityCardSubmission::select('id', 'name as nama', 'created_at', 'status', 'reason')
            ->where('user_id', Auth::id())
            ->get();

        return response()->json($documents);
    }

    private function birthCertificate()
    {
        $documents = BirthCertificateSubmission::select('id', 'name as nama', 'created_at', 'status', 'reason')
            ->where('user_id', Auth::id())
            ->get();

        return response()->json($documents);
    }

    private function familyCard()
    {
        $documents = FamilyCardSubmission::select('id', 'householder as nama','created_at', 'status', 'reason')
            ->where('user_id', Auth::id())
            ->get();

        return response()->json($documents);

    }

    private function childIdCard()
    {
        $documents = ChildIdSubmission::select('id', 'name as nama', 'created_at', 'status', 'reason')
            ->where('user_id', Auth::id())
            ->get();

        return response()->json($documents);
    }

    private function deathCertificate()
    {
        $document = DeathCertificateSubmission::select('id', 'name as nama', 'created_at', 'status', 'reason')
            ->where('user_id', Auth::id())
            ->get();
        return response()->json($document);
    }
}
