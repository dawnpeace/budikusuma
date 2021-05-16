<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\ChildIdSubmission;
use Illuminate\Support\Facades\Auth;


class ChildIdCardController extends Controller
{
    public function index()
    {
        return view("appliance.kia");
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "birthplace" => "required",
            "birthdate" => "required|date|date_format:d-m-Y",
            "gender" => [
                "required",
                Rule::in(["laki-laki", "perempuan"])
            ],
            "family_card_number" => "required|numeric",
            "householder_name" => "required",
            "birth_certificate_number" => "required",
            "citizenship" => "required",
            "address" => "required",
            "rt" => "required|numeric",
            "rw" => "required|numeric",
            "kecamatan" => "required",
            "kelurahan" => "required",
            "religion" => [
                "required",
                Rule::in(["kristen protestan", "kristen katolik", "islam", "buddha", "konghucu", "hindu"])
            ]
        ]);
        $request->request->add(["user_id" => Auth::id()]);
        ChildIdSubmission::create($request->all());
        return response([], 201);
    }
}
