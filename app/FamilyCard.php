<?php

namespace App;

use App\Traits\ClassName;
use App\Traits\Reprintable;
use Illuminate\Database\Eloquent\Model;

class FamilyCard extends Model
{
    use Reprintable, ClassName;

    protected $table = "stored_family_cards";

    protected $fillable = [
        "id_card", "householder", "householder_id_card", "rt", "rw", "zip_code", "kelurahan", "kabupaten",
        "kecamatan", "provinsi"
    ];

    private $cardIdName = "id_card";

    public function reprintable()
    {
        return $this->morphMany(ReprintRequest::class, 'reprintable');
    }
}
