<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyCardSubmission extends Model
{
    protected $table = "family_card_submissions";
    protected $fillable = [
        "id_number", "householder", "householder_id_card", "rt", "rw",
        "zipcode", "kelurahan", "kabupaten", "provinsi", "address"
    ];

    public function members()
    {
        return $this->hasMany(FamilyCardMemberSubmission::class, 'family_card_id');
    }

}
