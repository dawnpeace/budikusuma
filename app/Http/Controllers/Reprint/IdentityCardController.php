<?php

namespace App\Http\Controllers\Reprint;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\IdentityCard;
use Illuminate\Support\Carbon;

class IdentityCardController extends Controller
{
 
    private $MIN_MONTH_PAST = -4;  //including the current month
    
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
        
        $idCard = IdentityCard::where("identity_card_number", $request->identity_card_number)
            ->whereDate("birthdate", Carbon::createFromFormat('d-m-Y', $request->birthdate))
            ->first();
        
        if($idCard){
            return response()->json($idCard);
        }
        return response()->json([], 400);
    }

    public function addToReprint(Request $request)
    {
        $request->validate([
            "identity_card_number" => "required|numeric",
            "birthdate" => "required|date_format:d-m-Y"
        ]);

        $idCard = IdentityCard::where("identity_card_number", $request->identity_card_number)
            ->whereDate("birthdate", Carbon::createFromFormat('d-m-Y', $request->birthdate))
            ->first();
        
        if($idCard){
            $canReprint = $idCard->reprintable()->whereNull('printed_at')->count();
            if($canReprint){
                return response()->json([
                    "status" => "400",
                    "message" => "Anda masih memiliki permintaan yang sedang diproses !"
                ],400);
            } else {
                $dbLastPrint =  $idCard->reprintable()->orderBy('printed_at', 'DESC')->first();
                $lastPrintDate = Carbon::createFromFormat("Y-m-d H:i:s", $dbLastPrint->printed_at);
                $hasQueuedCard = Carbon::now()->diffInMonths($lastPrintDate, false);
                if($hasQueuedCard < $this->MIN_MONTH_PAST){
                    return response()->json([
                        "status" => "400",
                        "message" => "Anda masih memiliki permintaan yang sedang diproses !"
                    ], 400);
                }
            }
        }

        $idCard->reprintable()->create([
            'id_number' => $idCard->identity_card_number
        ]);
        
        return response()->json([], 201);
    }
}
