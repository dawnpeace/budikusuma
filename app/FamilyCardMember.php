<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyCardMember extends Model
{
    protected $table = "stored_family_card_members";

    protected $dates = [
        "birthdate"
    ];

    protected $fillable = [
        "name", "id_card", "gender", "birthplace", "birthdate", "religion",
        "education", "profession", "family_relation"
    ];
}
