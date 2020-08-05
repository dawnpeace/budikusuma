<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyCardMemberSubmission extends Model
{
    protected $table = "family_card_members_sumbissions";

    protected $dates = [
        "birthdate"
    ];

    protected $fillable = [
        "name", "id_card", "gender", "birthplace", "birthdate", "religion",
        "education", "profession", "family_relation"
    ];

    public function card()
    {
        return $this->belongsTo(FamilyCardMemberSubmission::class, 'family_card_id');
    }
}
