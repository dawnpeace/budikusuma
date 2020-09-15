<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FamilyCardSubmission extends Model
{

    use SoftDeletes;

    protected $table = "family_card_submissions";
    protected $fillable = [
        "id_number", "householder", "householder_id_card", "rt", "rw",
        "zipcode", "kelurahan", "kabupaten", "provinsi", "address", "kecamatan"
    ];

    public function members()
    {
        return $this->hasMany(FamilyCardMemberSubmission::class, 'family_card_id');
    }

}
