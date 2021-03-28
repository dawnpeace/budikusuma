<?php

namespace App\Http\Controllers\Admin;

use App\BirthCertificateSubmission;
use App\ChildIdSubmission;
use App\DeathCertificateSubmission;
use App\FamilyCardSubmission;
use App\Http\Controllers\Controller;
use App\IdentityCardSubmission;
use Illuminate\Http\Request;
class StatisticController extends Controller
{

    public function index()
    {
        $cards = [
            "ktp" => IdentityCardSubmission::getStats(),
            "kia" => ChildIdSubmission::getStats(),
            "kk" => FamilyCardSubmission::getStats(),
            "akta_lahir" => BirthCertificateSubmission::getstats(),
            "akta_kematian" => DeathCertificateSubmission::getStats()
        ];

        return view('admin.main', compact('cards'));
    }
    
}
