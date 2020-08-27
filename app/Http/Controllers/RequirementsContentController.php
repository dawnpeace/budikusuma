<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requirement;
use App\Enums\Document;
use Illuminate\Validation\Rule;

class RequirementsContentController extends Controller
{
    public function index()
    {
        $items = Requirement::whereIn('document', Document::ALL)->get();
        return view("content.requirements", compact('items'));
    }

    public function getItem(Request $request)
    {
        $request->validate([
            'document' => [
                'required',
                Rule::in(Document::ALL)
            ]
        ]);

        return Requirement::getDocument($request->document);
    }
}
