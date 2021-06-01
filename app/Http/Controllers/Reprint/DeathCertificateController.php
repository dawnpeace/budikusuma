<?php

namespace App\Http\Controllers\Reprint;

use App\Data\PdfData;
use App\DeathCertificate;
use App\enums\Document;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;
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

    public function pdf(DeathCertificate $card)
    {
        $card->load('user');
        $data = new PdfData();
        $data->setName($card->name);
        $data->setDocType(str_replace('_',' ',Document::AKTA_KEMATIAN));
        $data->setDocId($card->id);
        $data->setCardNo($card->card_number);
        $data->setPublishedAt($card->created_at->format('d-m-Y'));
        $data->setUserName($card->user->name);
        $pdf = PDF::loadView('pdf.pdf', $data);
        return $pdf->stream();
    }

}
