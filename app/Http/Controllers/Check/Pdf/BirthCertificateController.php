<?php

namespace App\Http\Controllers\Check\Pdf;

use App\BirthCertificateSubmission;
use App\Data\PdfData;
use App\Data\PdfStatusData;
use App\enums\Document;
use App\enums\DocumentStatus;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class BirthCertificateController extends Controller
{
    public function pdf(BirthCertificateSubmission $card)
    {
        if($card->status == DocumentStatus::DONE) {
            $card->load('user');
            $data = new PdfStatusData();
            $data->setName($card->name);
            $data->setCreatedAt($card->created_at->format('d-m-Y'));
            $data->setNote($card->reason);
            $data->setDocType(Document::AKTA_LAHIR);
            $pdf = PDF::loadView('pdf.pdf', $data);
            return $pdf->stream();
        }
        return response("", 403);
    }
}
