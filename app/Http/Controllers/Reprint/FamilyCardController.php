<?php

namespace App\Http\Controllers\Reprint;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FamilyCardController extends Controller
{
    public function index()
    {
        return view('reprint.kk');
    }

    public function submit(Request $request)
    {
        $request->validate([
            "id_card" => "required|numeric",
            "householder_id_card" => "required|numeric"
        ]);
    }

    public function addToReprint(Request $request)
    {
        $request->validate([
            "id_card" => "required|numeric",
            "householder_id_card" => "required|numeric"
        ]);
    }
}
