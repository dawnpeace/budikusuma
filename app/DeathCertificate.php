<?php

namespace App;

use App\Traits\Latest;
use App\Traits\Oldest;
use App\Traits\ClassName;
use Illuminate\Database\Eloquent\Model;

class DeathCertificate extends Model
{
    use Latest, Oldest, ClassName;

    protected $dates = [
        "published_at", "deceased_at", "birthdate"
    ];

    protected $fillable = [
        "name", "card_number", "identity_card", "note", "gender", "birthdate", "deceased_at", "published_at", "birthplace", "user_id", "status"
    ];
}
