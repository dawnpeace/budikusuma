<?php

namespace App;

use App\Traits\CheckNaturalId;
use App\Traits\ClassName;
use App\Traits\Latest;
use App\Traits\Oldest;
use App\Traits\Reprintable;
use Illuminate\Database\Eloquent\Model;

class FamilyCard extends Model
{
    use Reprintable, ClassName, Oldest, Latest;

    protected $table = "stored_family_cards";

    protected $fillable = [
        "id_card", "householder", "householder_id_card", "rt", "rw", "zip_code", "kelurahan", "kabupaten",
        "kecamatan", "provinsi", "address"
    ];

    private $cardIdName = "id_card";

    public function reprintable()
    {
        return $this->morphMany(ReprintRequest::class, 'reprintable');
    }

    public function members()
    {
        return $this->hasMany(FamilyCardMember::class, 'family_card_id');
    }

    
}
