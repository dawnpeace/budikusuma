<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyCardRenewal extends Model
{
    protected $table = 'family_card_renewal_requests';

    protected $fillable = [
        "id_card", "householder", "householder_id_card", "rt", "rw", "zip_code", "kelurahan", "kabupaten",
        "kecamatan", "provinsi", "address", "user_id", "note", "reason", "status"
    ];

    public function card()
    {
        return $this->belongsTo(FamilyCard::class, 'card_id');
    }

    public function members()
    {
        return $this->hasMany(FamilyCardRenewalMember::class, 'request_id');
    }
}
