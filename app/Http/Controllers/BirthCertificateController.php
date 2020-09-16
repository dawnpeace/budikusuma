<?php

namespace App\Http\Controllers;

use App\BirthCertificateSubmission;
use App\enums\Gender;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BirthCertificateController extends Controller
{
    public function index()
    {
        return view("appliance.akte-lahir");
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "gender" => [
                "required",
                Rule::in(Gender::ALL)
            ],
            "family_card_number" => "required|numeric",
            "birthdate" => "required|date|date_format:d-m-Y",
            "birthplace" => "required",
            "mother_identity_card_number" => "required|numeric",
            "mother_name" => "required",
            "father_identity_card_number" => "required|numeric",
            "father_name" => "required",
        ]);
        BirthCertificateSubmission::create($request->all());
        return response([], 201);
    }
}
