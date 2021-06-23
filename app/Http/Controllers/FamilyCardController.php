<?php

namespace App\Http\Controllers;

use App\enums\Religion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\FamilyCardSubmission;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FamilyCardController extends Controller
{
    public function index()
    {
        return view("appliance.kk");
    }

    public function store(Request $request)
    {
        $rules = $this->getStoreRule();
        $request->validate($rules);
        try{
            DB::beginTransaction();
            $familyCard = FamilyCardSubmission::create([
                "householder" => $request->householder_name,
                "householder_id_card" => $request->householder_id_card,
                "rt" => $request->rt,
                "rw" => $request->rw,
                "zipcode" => $request->zipcode,
                "kelurahan" => $request->kelurahan,
                "kecamatan" => $request->kecamatan,
                "kabupaten" => $request->kabupaten,
                "provinsi" => $request->provinsi,
                "address" => $request->address,
                "type" => $request->type,
                "user_id" => Auth::id()
            ]);
            $familyCard->members()->createMany($request->members);
            $familyCard->addMediaFromRequest('document')
                ->toMediaCollection();
            DB::commit();
            return response()->json([], 201);
        } catch (Exception $e){
            return response()->json(['message' => $e->getMessage()],500);
        }

    }

    private function getStoreRule()
    {
        return [
            "householder_name" => "required",
            "householder_id_card" => "required|numeric",
            "rt" => "required",
            "rw" => "required",
            "zipcode" => "required",
            "kelurahan" => "required",
            "address" => "required",
            "kecamatan" => "required",
            "kabupaten" => "required",
            "provinsi" => "required",
            "document" => "required|file|max:5000:mimes:pdf",
            "type" => "required",
            "members" => "required|array",
            "members.*.name" => "required",
            "members.*.gender" => [
                "required",
                Rule::in(["laki-laki", "perempuan"])
            ],
            "members.*.id_card" => "required|numeric",
            "members.*.birthdate" => "required|date_format:d-m-Y",
            "members.*.birthplace" => "required",
            "members.*.religion" => [
                "required",
                Rule::in(Religion::ALL)
            ],
            "members.*.education" => "required",
            "members.*.profession" => "required",
            "members.*.family_relation" => "required"
        ];
    }
}
