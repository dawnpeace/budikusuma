<?php

namespace App\Http\Controllers\Reprint;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\IdentityCard;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IdentityCardController extends Controller
{
    
    public function index()
    {
        return view('reprint.ktp');
    }

    public function submit(Request $request)
    {
        $request->validate([
            "identity_card_number" => "required|numeric",
            "birthdate" => "required|date_format:d-m-Y"
        ]);
        
        $idCard = $this->getIdentityCard($request->identity_card_number, $request->birthdate);

        return !is_null($idCard) ? response()->json($idCard, 200) : response()->json([], 404);
    }

    public function addToReprint(Request $request)
    {
        $request->validate([
            "identity_card_number" => "required|numeric",
            "birthdate" => "required|date_format:d-m-Y"
        ]);
        return DB::transaction(function() use ($request){
            $idCard = $this->getIdentityCard($request->identity_card_number, $request->birthdate);
            if (is_null($idCard)) return response()->json([], 404);
            try {
                $result = $idCard->submitReprint();
                return response()->json($result, 201);
            } catch (\Exception $e) {
                return response()->json(["message" => $e->getMessage()], 400);
            }
        });
    }


    private function getIdentityCard($idNumber, $birthdate)
    {
        return IdentityCard::where("identity_card_number", $idNumber)
            ->whereDate("birthdate", Carbon::createFromFormat('d-m-Y', $birthdate)->format('Y-m-d'))
            ->first();
    }
}
