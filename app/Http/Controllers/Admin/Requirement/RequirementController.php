<?php

namespace App\Http\Controllers\Admin\Requirement;

use App\enums\Document;
use App\Http\Controllers\Controller;
use App\Requirement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RequirementController extends Controller
{
    public function index()
    {
        $requirements = Requirement::loadRequirements();
        $submitUrl = route('admin.requirement.store');
        return view('admin.requirement.index', compact(['requirements', 'submitUrl']));
    }

    public function store(Request $request)
    {
        $request->validate([
            "document_type" => [
                "required",
                Rule::in(Document::ALL)
            ],
            "description" => "required"
        ]);

        Requirement::updateOrCreate(
            [ "document" => $request->document_type ],
            [ "description" => $request->description ]
        );
    }
}
