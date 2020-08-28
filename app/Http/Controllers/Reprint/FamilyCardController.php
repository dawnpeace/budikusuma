<?php

namespace App\Http\Controllers\Reprint;

use App\FamilyCard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $familyCard = $this->getFamilyCard($request->id_card, $request->householder_id_card);
        return is_null($familyCard) ? response()->json([], 404) : response()->json($familyCard);
    }

    public function addToReprint(Request $request)
    {
        $request->validate([
            "id_card" => "required|numeric",
            "householder_id_card" => "required|numeric"
        ]);
        return DB::transaction(function() use ($request){
            $idCard = $this->getFamilyCard($request->id_card, $request->householder_id_card);

            if (!$idCard) return response()->json([], 404);

            try {
                $result = $idCard->submitReprint();
                return response()->json($result, 201);
            } catch (\Exception $e) {
                return response(["message" => $e->getMessage()], 400);
            }
        });
        
    }

    private function getFamilyCard($idCard, $householderId)
    {
        return FamilyCard::where("id_card", $idCard)
            ->where("householder_id_card", $householderId)
            ->first();
    }
}
