<?php

namespace App\Http\Controllers\Reprint;

use App\ChildIdentityCard;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChildIdentityCardController extends Controller
{
    public function index()
    {
        $cards = ChildIdentityCard::where('user_id', Auth::id())
            ->with(["reprints"])
            ->orderBy('created_at', 'desc')
            ->get();

        $hasPrinted = ChildIdentityCard::hasJustPrinted();


        if (count($cards) == 0) {
            abort(404);
        }

        return view('reprint.kia', compact(["cards", "hasPrinted"]));
    }

    public function submit(Request $request)
    {
        $card = ChildIdentityCard::where('id', $request->card)
            ->withCount(['reprints' => function (Builder $builder) {
                $builder->whereBetween('created_at', [Carbon::now()->addMonths(-2), Carbon::now()]);
            }])
            ->firstOrFail();

        if (!$card->reprints_count) {
            $reprint = $card->createReprint(Auth::id());
            return response()->json($reprint, 201);
        }

        return response()->json(["death_certificate" => "There's processed request"], 422);
    }
}
