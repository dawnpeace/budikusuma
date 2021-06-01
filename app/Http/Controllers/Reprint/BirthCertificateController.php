<?php

namespace App\Http\Controllers\Reprint;

use App\BirthCertificate;
use App\Data\PdfData;
use App\enums\Document;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BirthCertificateController extends Controller
{
    public function index()
    {
        $cards = BirthCertificate::where('user_id', Auth::id())
            ->with(["reprints"])
            ->orderBy('created_at', 'desc')
            ->get();

        $hasPrinted = BirthCertificate::hasJustPrinted();

        if (count($cards) == 0) {
            abort(404);
        }

        return view('reprint.akta-lahir', compact(["cards", "hasPrinted"]));
    }

    public function submit(Request $request)
    {
        $card = BirthCertificate::where('id', $request->card)
            ->withCount(['reprints' => function (Builder $builder) {
                $builder->whereBetween('created_at', [Carbon::now()->addMonths(-2), Carbon::now()]);
            }])
            ->firstOrFail();

        if (!$card->reprints_count) {
            $reprint = $card->createReprint(Auth::id());
            return response()->json($reprint, 201);
        }

        return response()->json(["birth_certificate" => "There's processed request"], 422);
    }

    public function pdf(BirthCertificate $card)
    {
        $card->load('user');
        $data = new PdfData();
        $data->setName($card->name);
        $data->setDocType(Document::AKTA_LAHIR);
        $data->setDocId($card->id);
        $data->setCardNo($card->id_card);
        $data->setPublishedAt($card->created_at->format('d-m-Y'));
        $data->setUserName($card->user->name);
        $pdf = PDF::loadView('pdf.pdf', $data);
        return $pdf->stream();
    }


}
