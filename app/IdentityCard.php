<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdentityCard extends Model
{
    protected $table = "identity_cards";

    protected $dates = [ "birthdate" ];

    protected $fillable = [
        "identity_card_number", "name", "gender", "address",
        "birthplace", "birthdate", "rt", "rw", "kelurahan",
        "kecamatan", "religion", "marriage_status", "profession", "nationality"
    ];

    public function reprintable()
    {
        return $this->morphMany(ReprintRequest::class, 'reprintable');
    }
}
