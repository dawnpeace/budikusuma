<?php

namespace App\Http\Controllers\Reprint;

use App\BirthCertificate;
use App\DeathCertificate;
use App\FamilyCard;
use App\ChildIdentityCard;
use App\Http\Controllers\Controller;
use App\IdentityCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyDocumentController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        
        $deathCertificate = DeathCertificate::where('user_id', $userId)
            ->first();

        $birthCertificate = BirthCertificate::where('user_id', $userId)
            ->first();

        $identityCard = IdentityCard::where('user_id', $userId)
            ->first();

        $familyCard = FamilyCard::where('user_id', $userId)
            ->first();

        $childIdentityCard = ChildIdentityCard::where('user_id', $userId)
            ->first();


        $hasNoDocument = is_null($deathCertificate) && is_null($birthCertificate) && is_null($identityCard) && is_null($familyCard) && is_null($childIdentityCard);
    
        return view("reprint.document", compact(['deathCertificate', 'birthCertificate', 'identityCard', 'familyCard', 'childIdentityCard', 'hasNoDocument']));
    }
}
