<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyCardRenewalMember extends Model
{
    protected $table = 'family_card_renewal_members';

    protected $dates = [
        'birthdate'
    ];

    protected $fillable = [
        "name", "id_card", "gender", "birthplace", "birthdate", "religion",
        "education", "profession", "family_relation", "request_id"
    ];

    public function card()
    {
        return $this->belongsTo(FamilyCardRenewal::class, 'request_id');
    }

}
