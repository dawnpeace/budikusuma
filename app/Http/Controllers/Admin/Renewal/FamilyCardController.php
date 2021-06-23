<?php

namespace App\Http\Controllers\Admin\Renewal;

use App\Element\Button;
use App\enums\DocumentStatus;
use App\enums\Gender;
use App\enums\Religion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FamilyCardRenewal;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Arr;

class FamilyCardController extends Controller
{

    private $baseRouteName = 'admin.renewal.kk';

    public function index()
    {
        return view('admin.renewal.kk.index');
    }

    public function datatable()
    {
        $card = FamilyCardRenewal::query()
            ->select(['id_card', 'householder', 'status', 'created_at', 'id']);

        return DataTables::of($card)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return Button::checkButton(route($this->baseRouteName . '.edit', $row));
            })
            ->make(true);
    }

    public function edit(FamilyCardRenewal $card)
    {
        $card->load("card", "members");
        return view('admin.renewal.kk.edit', compact('card'));
    }

    public function update(FamilyCardRenewal $card, Request $request)
    {
        $card->load("card.members", "members");
        $validated = $request->validate($this->getRule());
        return DB::transaction(function () use ($card, $validated){
            $familyCardRequest = Arr::except($validated, ['members', 'reason', 'note']);
            $familyCardMembersRequest = Arr::only($validated, 'members')['members'];
            $card->update($familyCardRequest);
            foreach ($card->members as $member) {
                foreach($familyCardMembersRequest as $memberRequest) {
                    if($member->id == $memberRequest['id']) {
                        $member->update($memberRequest);
                    }
                }
            }

            if($validated['status'] == DocumentStatus::DONE) {
                $stored = $card->card;
                $stored->update(Arr::except($familyCardRequest, 'status'));
                $stored->members()->delete();
                $stored->members()->createMany($familyCardMembersRequest);
            }
            return $card;
        });

    }

    private function getRule()
    {
        return [
            "householder" => "required",
            "householder_id_card" => "required|numeric",
            "address" => "required",
            "rt" => "required",
            "rw" => "required",
            "zip_code" => "required",
            "kelurahan" => "required",
            "kecamatan" => "required",
            "kabupaten" => "required",
            "provinsi" => "required",
            "reason" => "required",
            "status" => [
                "required",
                Rule::in(DocumentStatus::ALL)
            ],
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
        ];
    }
}
