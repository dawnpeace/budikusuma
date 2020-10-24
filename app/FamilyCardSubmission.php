<?php

namespace App;

use App\Exceptions\NaturalIdUsedExceptions;
use App\Traits\Latest;
use App\Traits\Oldest;
use App\Traits\Statistic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class FamilyCardSubmission extends Model
{

    use SoftDeletes, Statistic, Latest, Oldest;

    protected $table = "family_card_submissions";
    protected $fillable = [
        "id_number", "householder", "householder_id_card", "rt", "rw",
        "zipcode", "kelurahan", "kabupaten", "provinsi", "address", "kecamatan", "status"
    ];

    public function members()
    {
        return $this->hasMany(FamilyCardMemberSubmission::class, 'family_card_id');
    }

    public function publish()
    {
        $members = $this->members->toArray();
        $hasId = FamilyCard::where('id_card', $this->id_number)->count();
        if (!$hasId) {
            DB::transaction(function() use ($members){
                $publish = new FamilyCard();
                $publish->id_card = $this->id_number;
                $publish->householder = $this->householder;
                $publish->householder_id_card = $this->householder_id_card;
                $publish->rt = $this->rt;
                $publish->rw = $this->rw;
                $publish->zip_code = $this->zipcode;
                $publish->kelurahan = $this->kelurahan;
                $publish->kabupaten = $this->kabupaten;
                $publish->kecamatan = $this->kecamatan;
                $publish->provinsi = $this->provinsi;
                $publish->address = $this->address;
                $publish->save();

                $publish->members()->createMany($members);
            });
        } else {
            throw new NaturalIdUsedExceptions($this->id_mumber);
        }


    }

}
