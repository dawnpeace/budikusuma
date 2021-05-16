<?php

namespace App\Http\Controllers\Reprint;

use App\DeathCertificate;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeathCertificateController extends Controller
{
    public function index()
    {
        $cards = DeathCertificate::where('user_id', Auth::id())
            ->with(["reprints"])
            ->orderBy('created_at', 'desc')
            ->get();

        $hasPrinted = DeathCertificate::hasJustPrinted();

        if (count($cards) == 0) {
            abort(404);
        }

        return view('reprint.akta-kematian', compact(["cards", "hasPrinted"]));
    }

    public function submit(Request $request)
    {
        $card = DeathCertificate::where('id', $request->card)
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
