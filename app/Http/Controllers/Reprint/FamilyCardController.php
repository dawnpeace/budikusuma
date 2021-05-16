<?php

namespace App\Http\Controllers\Reprint;

use App\FamilyCard;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FamilyCardController extends Controller
{

    public function index()
    {
        $cards = FamilyCard::where('user_id', Auth::id())
            ->with(["reprints"])
            ->orderBy('created_at', 'desc')
            ->get();
        
        $hasPrinted = FamilyCard::hasJustPrinted();

        if (count($cards) == 0) {
            abort(404);
        }

        return view('reprint.kk', compact(["cards", "hasPrinted"]));
    }

    public function submit(Request $request)
    {
        $card = FamilyCard::where('id', $request->card)
            ->withCount(['reprints' => function (Builder $builder) {
                $builder->whereBetween('created_at', [Carbon::now()->addMonths(-2), Carbon::now()]);
            }])
            ->firstOrFail();

        if (!$card->reprints_count) {
            $reprint = $card->createReprint(Auth::id());
            return response()->json($reprint, 201);
        }

        return response()->json(["family_card" => "There's processed request"], 422);
    }

}
