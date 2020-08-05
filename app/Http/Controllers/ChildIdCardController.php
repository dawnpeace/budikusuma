<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\ChildIdSubmission;

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
            "gender" => [
                "required",
                Rule::in(["laki-laki", "perempuan"])
            ],
            "family_card_number" => "required|numeric",
            "birthdate" => "required|date|date_format:d-m-Y",
            "mother_identity_card_number" => "required|numeric",
            "father_identity_card_number" => "required|numeric"
        ]);
        ChildIdSubmission::create($request->all());
        return response([], 201);
    }
}
