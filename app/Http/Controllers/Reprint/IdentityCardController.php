<?php

namespace App\Http\Controllers\Reprint;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\IdentityCard;
use App\ReprintRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IdentityCardController extends Controller
{
    
    public function index()
    {
        $cards = IdentityCard::where('user_id', Auth::id())
            ->with(['reprints'])
            ->get();
    
        $hasPrinted = IdentityCard::hasJustPrinted();

        if(count($cards) == 0) {
            abort(404);
        }

        return view('reprint.ktp', compact(["cards", "hasPrinted"]));
    }

    public function submit(Request $request) 
    {
    
        $card = IdentityCard::where('id', $request->card)
            ->withCount(['reprints' => function(Builder $builder) {
                $builder->whereBetween('created_at', [Carbon::now()->addMonths(-2), Carbon::now()]);
            }])
            ->firstOrFail();
        
        if($card->reprints_count == 0) {
            $reprint = $card->createReprint(Auth::id());
            return response()->json($reprint, 201);
        }
        
        return response()->json(["identity_card" => "There's processed request"], 422);
    }

}
