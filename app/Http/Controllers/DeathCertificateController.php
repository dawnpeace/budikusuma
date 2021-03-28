<?php

namespace App\Http\Controllers;

use App\DeathCertificateSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeathCertificateController extends Controller
{
    public function index()
    {
        return view("appliance.akta-kematian");
    }

    public function store(Request $request)
    {
        $rules = [
            "identity_card" => "required|numeric",
            "deceased_at" => "date|date_format:d-m-Y",
            "birthdate" => "date|date_format:d-m-Y",
            "name" => "required", 
            "birthplace" => "required",
            
        ];

        $request->validate($rules);
        $data = $request->all();
        $data['user_id'] = Auth::id();
        DeathCertificateSubmission::create($data);
        return response()->json([], 201);
    }
}
