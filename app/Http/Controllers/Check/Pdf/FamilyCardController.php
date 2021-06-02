<?php

namespace App\Http\Controllers\Check\Pdf;

use App\Data\PdfData;
use App\Data\PdfStatusData;
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
            $data = new PdfStatusData();
            $data->setName($card->householder);
            $data->setCreatedAt($card->created_at->format('d-m-Y'));
            $data->setNote($card->reason);
            $data->setDocType(Document::KK);
            $pdf = PDF::loadView('pdf.status', $data);
            return $pdf->stream();
        }
        return response("", 403);
    }
}
