<?php

namespace App\Http\Controllers\Reprint;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ReprintRequest;
use Illuminate\Validation\Rule;

class ReprintRequestController extends Controller
{
    public function create()
    {
        return view('reprint.cek');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'document_type' => [
                'required',
                Rule::in(['ktp', 'kk', 'kia', 'akta-lahir'])
            ],
            'card_number' => 'required'
        ]);

        $type = $this->toStringModelName($request->document_type);
        $data = ReprintRequest::where('reprintable_type', $type)
            ->where('id_number', $request->card_number)
            ->first();

        return !is_null($data) ? response()->json($data, 200) : response()->json([], 400);
    }

    private function toStringModelName($documentType)
    {
        switch ($documentType) {
            case 'ktp':
                return 'App\IdentityCard';
            case 'kk':
                return 'App\FamilyCard';
            case 'kia':
                return 'App\ChildIdentityCard';
            case 'akta-lahir':
                return 'App\BirthCertificate';
        }
    }

}
