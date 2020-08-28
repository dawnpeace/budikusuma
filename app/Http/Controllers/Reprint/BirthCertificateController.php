<?php

namespace App\Http\Controllers\Reprint;

use App\BirthCertificate;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BirthCertificateController extends Controller
{
    public function index()
    {
        return view('reprint.akta-lahir');
    }

    public function submit(Request $request)
    {
        $request->validate([
            "mother_identity_card_number" => "required|numeric",
            "birthdate" => "required|date_format:d-m-Y"
        ]);

        $children = $this->getBirthCertificate($request->mother_identity_card_number, $request->birthdate);
        
        return count($children) ? response()->json($children) : response()->json([], 404);
    }

    public function addToReprint(Request $request)
    {
        $request->validate([
            "mother_identity_card_number" => "required|numeric",
            "birthdate" => "required|date_format:d-m-Y",
            "id" => "required"
        ]);

        return DB::transaction(function() use ($request){
            $birthCertificate = $this->getBirthCertificate($request->mother_identity_card_number, $request->birthdate, $request->id);
            
            if(is_null($birthCertificate)) return response()->json([], 404);
    
            try{
                $birthCertificate->submitReprint();
                return response()->json([], 201);
            } catch (Exception $e){
                return response()->json(["message" => $e->getMessage()], 400);
            }
        });
    }

    public function getBirthCertificate($motherIdCard, $birthdate, $id = null)
    {
        $builder = BirthCertificate::where('mother_identity_card_number', $motherIdCard)
            ->where('birthdate', Carbon::createFromFormat('d-m-Y', $birthdate)->format('Y-m-d'));
        return !is_null($id) ? $builder->where('id', $id)->first() : $builder->get();
    }
}
