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
            "document" => "required|file|max:5000|mimes:pdf"
        ];

        $request->validate($rules);

        \DB::transaction(function () use ($request) {
            $request->request->add(["user_id" => Auth::id()]);
            $card = DeathCertificateSubmission::create($request->all());
            $card->addMediaFromRequest('document')
                ->toMediaCollection();
        });
        return response()->json([], 201);
    }
}
