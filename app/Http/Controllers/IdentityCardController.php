<?php

namespace App\Http\Controllers;

use App\Enums\DocumentStatus;
use App\enums\MarriageStatus;
use App\IdentityCardSubmission;
use Illuminate\Http\Request;
use App\KtpSubmission;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

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
            "rt" => "required|numeric",
            "rw" => "required|numeric",
            "kelurahan" => "required",
            "kecamatan" => "required",
            "profession" => "required",
            "religion" => [
                "required",
                Rule::in(["kristen protestan", "kristen katolik", "islam", "buddha", "konghucu"])
            ],
            "marriage_status" => [
                "required",
                Rule::in(MarriageStatus::ALL)
            ],
            "nationality" => "required"
        ]);
        
        $request->request->add(["user_id" => Auth::id()]);
        IdentityCardSubmission::create($request->all());
        return response()->json([], 201);
    }
}
