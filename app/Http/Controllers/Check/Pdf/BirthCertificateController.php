<?php

namespace App\Http\Controllers\Check\Pdf;

use App\BirthCertificateSubmission;
use App\Data\PdfData;
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
        return response("", 403);
    }
}
