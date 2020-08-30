<?php

namespace App\Http\Controllers\Check;

use App\BirthCertificateSubmission;
use App\ChildIdSubmission;
use App\enums\Document;
use App\FamilyCardSubmission;
use App\Http\Controllers\Controller;
use App\IdentityCard;
use App\IdentityCardSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MainController extends Controller
{

    private $request;
    private $dateFormat = 'd-m-Y';

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        return view('check-submission.index');
    }

    public function submit()
    {
        if(!$this->request->has('document')){
            return response()->json([
                "message" => "Please set the document type"
            ], 400);
        }

        switch($this->request->document){
            case Document::KTP:
                return $this->identityCard($this->request);
            case Document::AKTA_LAHIR:
                return $this->birthCertificate();
            case Document::KIA:
                return $this->childIdCard();
            case Document::KK:
                return $this->familyCard();
        }
    }

    private function identityCard()
    {
        $this->request->validate([
            'submission_date' => 'required|date|date_format:d-m-Y',
            'name' => 'required',
            'birthdate' => 'required|date|date_format:d-m-Y'
        ]);

        $birthdate = Carbon::createFromFormat($this->dateFormat, $this->request->get('birthdate'));
        $submissionDate = Carbon::createFromFormat($this->dateFormat, $this->request->get('submission_date'));

        $documents = IdentityCardSubmission::select('name as nama', 'address as alamat', 'status')
            ->where('name', $this->request->get('name'))
            ->whereDate('birthdate', $birthdate)
            ->whereDate('created_at', $submissionDate)
            ->get();

        return response()->json($documents);
    }

    private function birthCertificate()
    {
        $this->request->validate([
            'name' => 'required',
            'mother_identity_card_number' => 'required|numeric',
            'submission_date' => 'required|date|date_format:d-m-Y',
            'birthdate' => 'required|date|date_format:d-m-Y',
        ]);

        $birthdate = Carbon::createFromFormat($this->dateFormat, $this->request->get('birthdate'));
        $submissionDate = Carbon::createFromFormat($this->dateFormat, $this->request->get('submission_date'));

        $documents = BirthCertificateSubmission::select('name as nama', 'mother_name as ibu','gender as jenis_kelamin' , 'status')
            ->whereDate('birthdate', $birthdate)
            ->whereDate('created_at', $submissionDate)
            ->where('mother_identity_card_number', $this->request->get('mother_identity_card_number'))
            ->get();

        return response()->json($documents);
    }

    private function familyCard()
    {
        $this->request->validate([
            'householder' => 'required',
            'householder_id_card' => 'required|numeric',
            'submission_date' => 'required|date|date_format:d-m-Y',
        ]);

        $submissionDate = Carbon::createFromFormat($this->dateFormat, $this->request->get('submission_date'));

        $documents = FamilyCardSubmission::select('householder as kepala_keluarga', 'address as alamat', 'status')
            ->where('householder', $this->request->get('householder'))
            ->where('householder_id_card', $this->request->get('householder_id_card'))
            ->whereDate('created_at', $submissionDate)
            ->get();

        return response()->json($documents);

    }

    private function childIdCard()
    {
        $this->request->validate([
            'submission_date' => 'required|date|date_format:d-m-Y',
            'name' => 'required',
            'family_card_number' => 'required|numeric',
            'birthdate' => 'required|date|date_format:d-m-Y',
        ]);

        $submissionDate = Carbon::createFromFormat($this->dateFormat, $this->request->get('submission_date'));
        $birthdate = Carbon::createFromFormat($this->dateFormat, $this->request->get('birthdate'));


        $documents = ChildIdSubmission::select('name as nama', 'address as alamat','gender as jenis_kelamin' ,'status')
            ->where('name', $this->request->get('name'))
            ->where('family_card_number', $this->request->get('family_card_number'))
            ->whereDate('created_at', $submissionDate)
            ->whereDate('birthdate', $birthdate)
            ->get();
        
        return response()->json($documents);
    }
}
