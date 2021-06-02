<?php

namespace App\Http\Controllers\Check\Pdf;

use App\Data\PdfData;
use App\Data\PdfStatusData;
use App\DeathCertificateSubmission;
use App\enums\Document;
use App\enums\DocumentStatus;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;

class DeathCertificateController extends Controller
{
    public function pdf(DeathCertificateSubmission $card)
    {
        if($card->status == DocumentStatus::DONE) {
            $card->load('user');
            $data = new PdfStatusData();
            $data->setName($card->name);
            $data->setCreatedAt($card->created_at->format('d-m-Y'));
            $data->setNote($card->note);
            $data->setDocType(Document::AKTA_KEMATIAN);
            $pdf = PDF::loadView('pdf.status', $data);
            return $pdf->stream();
        }
        return response("", 403);
    }

}
