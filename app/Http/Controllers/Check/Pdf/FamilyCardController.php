<?php

namespace App\Http\Controllers\Check\Pdf;

use App\Data\PdfData;
use App\enums\Document;
use App\enums\DocumentStatus;
use App\FamilyCardSubmission;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;

class FamilyCardController extends Controller
{
    public function pdf(FamilyCardSubmission $card)
    {
        if($card->status == DocumentStatus::DONE) {
            $card->load('user');
            $data = new PdfData();
            $data->setName($card->householder);
            $data->setDocType(Document::AKTA_LAHIR);
            $data->setDocId($card->id);
            $data->setCardNo($card->id_number);
            $data->setPublishedAt($card->created_at->format('d-m-Y'));
            $data->setUserName($card->user->name);
            $pdf = PDF::loadView('pdf.pdf', $data);
            return $pdf->stream();
        }
        return response("", 403);
    }
}
