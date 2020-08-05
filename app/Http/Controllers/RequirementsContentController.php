<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requirement;
use App\Enums\Document;
use Illuminate\Support\Facades\Log;
use PhpParser\Comment\Doc;

class RequirementsContentController extends Controller
{
    public function index()
    {
        $items = [
            [
                "name" => "KTP",
                "url" => route('requirement.ktp')
            ],
            [
                "name" => "KK",
                "url" => route('requirement.kk')
            ],
            [
                "name" => "KIA",
                "url" => route('requirement.kia')
            ],
            [
                "name" => "AL",
                "url" => route('requirement.al')
            ],
        ];
        return view("content.requirements", compact('items'));
    }

    public function ktp()
    {
        $ktp = Requirement::getDocument(Document::KTP);
        return view("content.ktp", compact('ktp'));
    }

    public function kk()
    {
        $kk = Requirement::getDocument(Document::KK);
        return view("content.kk", compact('kk'));
    }

    public function kia()
    {
        $kia = Requirement::getDocument(Document::KIA);
        return view("content.kia", compact('kia'));
    }

    public function aktaLahir()
    {
        $al = Requirement::getDocument(Document::AKTA_LAHIR);
        return view("content.akta", compact('al'));
    }

    public function ktpSubmit(Request $request)
    {
        return Requirement::updateOrCreate(
            [ "document" => Document::KTP ],
            [ "description" => $request->data ]
        );
    }


    public function kkSubmit(Request $request)
    {
        return Requirement::updateOrCreate(
            [ "document" => Document::KK ],
            [ "description" => $request->data ]
        );
    }

    public function kiaSubmit(Request $request)
    {
        return Requirement::updateOrCreate(
            [ "document" => Document::KIA ],
            [ "description" => $request->data ]
        );
    }

    public function aktaLahirSubmit(Request $request)
    {
        return Requirement::updateOrCreate(
            ["document" => Document::AKTA_LAHIR],
            ["description" => $request->data]
        );
    }
}
