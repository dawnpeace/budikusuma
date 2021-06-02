<?php

namespace App\Http\Controllers\Check\Pdf;

use App\ChildIdSubmission;
use App\Data\PdfData;
use App\Data\PdfStatusData;
use App\enums\Document;
use App\enums\DocumentStatus;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class ChildIdCardController extends Controller
{
    public function pdf(ChildIdSubmission $card)
    {
        if($card->status == DocumentStatus::DONE) {
            $card->load('user');
            $data = new PdfStatusData();
            $data->setName($card->name);
            $data->setCreatedAt($card->created_at->format('d-m-Y'));
            $data->setDocType(Document::KIA);
            $data->setNote($card->note);
            $pdf = PDF::loadView('pdf.status', $data);
            return $pdf->stream();
        }
        return response("", 403);
    }
}
