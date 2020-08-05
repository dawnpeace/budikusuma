<?php

namespace App\Http\Controllers;

use App\Enums\DocumentStatus;
use Illuminate\Http\Request;
use App\KtpSubmission;
use Illuminate\Validation\Rule;

class IdentityCardController extends Controller
{
    public function index()
    {
        return view("appliance.ktp");
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "gender" => [
                "required",
                Rule::in(['laki-laki', 'perempuan']),
            ],
            "birthplace" => "required",
            "birthdate" => "required|date|date_format:d-m-Y",
            "address" => "required",
            "rt" => "required",
            "rw" => "required",
            "kelurahan" => "required",
            "kecamatan" => "required",
            "profession" => "required",
            "religion" => [
                "required",
                Rule::in(["kristen protestan", "kristen katolik", "islam", "buddha", "konghucu"])
            ],
            "marriage_status" => [
                "required",
                Rule::in(["not_married", "married", "widowed"])
            ],
            "nationality" => "required"
        ]);

        KtpSubmission::create($request->all());
        return response([],201)->json();
    }
}
