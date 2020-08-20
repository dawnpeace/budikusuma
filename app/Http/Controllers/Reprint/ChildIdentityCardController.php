<?php

namespace App\Http\Controllers\Reprint;

use App\ChildIdentityCard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChildIdentityCardController extends Controller
{
    public function index()
    {
        return view('reprint.kia');
    }

    public function submit(Request $request)
    {
        $request->validate([
            "card_number" => "required|numeric",
            "family_card_number" => "required|numeric"
        ]);

        $childIdCard = $this->getChildIdCard($request->card_number, $request->family_card_number);
        return is_null($childIdCard) ? response()->json([], 404) : response()->json($childIdCard);
    }

    public function addToReprint(Request $request)
    {
        $request->validate([
            "card_number" => "required|numeric",
            "family_card_number" => "required|numeric"
        ]);

        $childIdCard = $this->getChildIdCard($request->card_number, $request->family_card_number);

        try {
            $result = $childIdCard->submitReprint();
            return response()->json($result, 201);
        } catch (\Exception $e) {
            return response(["message" => $e->getMessage()], 400);
        }
    }

    private function getChildIdCard($cardNumber, $familyCardNumber){
        return ChildIdentityCard::where("card_number", $cardNumber)
            ->where('family_card_number', $familyCardNumber)
            ->first();
    }
}
