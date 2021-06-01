<?php


namespace App\Http\Controllers\Check\Pdf;


use App\Data\PdfData;
use App\enums\Document;
use App\enums\DocumentStatus;
use App\Http\Controllers\Controller;
use App\IdentityCardSubmission;
use Barryvdh\DomPDF\Facade as PDF;

class IdentityCardController extends Controller
{

    public function pdf(IdentityCardSubmission $card)
    {
        if($card->status == DocumentStatus::DONE) {
            $card->load('user');
            $data = new PdfData();
            $data->setName($card->name);
            $data->setDocType(Document::KTP);
            $data->setDocId($card->id);
            $data->setCardNo($card->id_card);
            $data->setPublishedAt($card->created_at->format('d-m-Y'));
            $data->setUserName($card->user->name);
            $pdf = PDF::loadView('pdf.pdf', $data);
            return $pdf->stream();
        }
        return response("", 403);
    }
}
