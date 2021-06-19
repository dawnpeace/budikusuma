<?php

namespace App\Http\Controllers\Renewal;

use App\enums\Gender;
use App\enums\Religion;
use App\FamilyCard;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class FamilyCardController extends Controller
{
    public function index()
    {
        $cards = FamilyCard::query()
            ->where('user_id', Auth::id())
            ->withCount([
                'renewal' => function(Builder $query) {
                    $query->whereBetween('created_at', [Carbon::now()->addMonths(-2), Carbon::now()]);
                }
            ])
            ->with('renewal')
            ->get();
        return view("renewal.kk.index", compact('cards'));
    }

    public function edit(FamilyCard $card)
    {
        $card->load('members');
        return view("renewal.kk.edit", compact('card'));
    }

    public function store(FamilyCard $card, Request $request)
    {
        $validated = $request->validate([
            "householder" => "required",
            "householder_id_card" => "required|numeric",
            "address" => "required",
            "id_card" => "required",
            "rt" => "required",
            "rw" => "required",
            "zip_code" => "required",
            "kelurahan" => "required",
            "kecamatan" => "required",
            "kabupaten" => "required",
            "provinsi" => "required",
            "note" => "required",
            "members" => "required|array",
            "members.*.name" => "required",
            "members.*.gender" => [
                "required",
                Rule::in(Gender::ALL)
            ],
            "members.*.id_card" => "required|numeric",
            "members.*.birthdate" => "required|date|date_format:d-m-Y",
            "members.*.birthplace" => "required",
            "members.*.religion" => [
                "required",
                Rule::in(Religion::ALL)
            ],
            "members.*.education" => "required",
            "members.*.profession" => "required",
            "members.*.family_relation" => "required",
        ]);


        return DB::transaction(function () use ($validated, $card) {
            $renewalData = Arr::except($validated, 'members');
            $renewalData["user_id"] = Auth::id();
            $renewalData["id_card"] = $card->id_card;

            $renewal = $card->renewal()
                ->create($renewalData);

            $renewalMembers = Arr::only($validated, 'members')['members'];

            $renewal->members()
                ->createMany($renewalMembers);

            return response()->json($renewal, 201);
        });

    }
}
