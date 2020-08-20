<?php

namespace App;

use App\Traits\Reprintable;
use Illuminate\Database\Eloquent\Model;

class IdentityCard extends Model
{

    use Reprintable;

    protected $table = "identity_cards";

    protected $dates = [ "birthdate" ];

    private $cardIdName = "identity_card_number";

    protected $fillable = [
        "identity_card_number", "name", "gender", "address",
        "birthplace", "birthdate", "rt", "rw", "kelurahan", "address",
        "kecamatan", "religion", "marriage_status", "profession", "nationality"
    ];

    public function reprintable()
    {
        return $this->morphMany(ReprintRequest::class, 'reprintable');
    }

}
