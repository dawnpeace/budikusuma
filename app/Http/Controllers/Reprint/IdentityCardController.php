<?php

namespace App\Http\Controllers\Reprint;

use App\Data\PdfData;
use App\enums\Document;
use App\enums\ReprintType;
use App\Http\Controllers\Controller;
use App\IdentityCard;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
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
            $reprint = $card->createReprint(Auth::id(), $request->type);
            if($request->type == ReprintType::LOST) {
                $reprint->addMediaFromRequest('pengantar')
                    ->toMediaCollection('pengantar');

                $reprint->addMediaFromRequest('kehilangan')
                    ->toMediaCollection('kehilangan');

                $reprint->addMediaFromRequest('pendukung')
                    ->toMediaCollection('pendukung');
            } else {
                $reprint->addMediaFromRequest('dokumen_rusak')
                    ->toMediaCollection('dokumen_rusak');

                $reprint->addMediaFromRequest('pengantar')
                    ->toMediaCollection('pengantar');
            }
            return response()->json($reprint, 201);
        }

        return response()->json(["identity_card" => "There's processed request"], 422);
    }

    public function pdf(IdentityCard $card)
    {
        $card->load('user');
        $data = new PdfData();
        $data->setName($card->name);
        $data->setDocType(Document::KTP);
        $data->setDocId($card->id);
        $data->setCardNo($card->identity_card_number);
        $data->setPublishedAt($card->created_at->format('d-m-Y'));
        $data->setUserName($card->user->name);
        $pdf = PDF::loadView('pdf.pdf', $data);
        return $pdf->stream();
    }

}
