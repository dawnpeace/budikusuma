<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\FamilyCardSubmission;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
                "kabupaten" => $request->kabupaten,
                "provinsi" => $request->provinsi,
            ]);
            $familyCard->members()->createMany($request->members);
            DB::commit();
            return response()->json([], 201);
        } catch (Exception $e){
            DB::rollBack();
            Log::debug($e->getMessage());
        }
        
    }

    private function getStoreRule()
    {
        return [
            "householder_name" => "required",
            "address" => "required",
            "rt" => "required",
            "rw" => "required",
            "zipcode" => "required",
            "kelurahan" => "required",
            "kecamatan" => "required",
            "kabupaten" => "required",
            "provinsi" => "required",
            "members" => "required|array",
            "members.*.name" => "required",
            "members.*.marriage_status" => [
                "required",
                Rule::in(["not_married", "married", "widowed"])
            ],
            "members.*.gender" => [
                "required",
                Rule::in(["laki-laki", "perempuan"])
            ],
            "members.*.id_card" => "required|numeric",
            "members.*birthdate" => "required|date_format:d-m-Y",
            "members.*birthplace" => "required",
            "members.*.religion" => [
                "required",
                Rule::in(["kristen protestan", "kristen katolik", "islam", "buddha", "konghucu"])
            ],
            "members.*.education" => "required",
            "members.*.profession" => "required",
            "members.*.family_relation" => "required"
        ];
    }
}
