<?php

namespace App;

use App\Traits\ClassName;
use App\Traits\Latest;
use App\Traits\Oldest;
use App\Traits\Reprintable;
use Illuminate\Database\Eloquent\Model;

class ChildIdentityCard extends Model
{

    use Reprintable, ClassName, Latest, Oldest;

    protected $cardIdName = "card_number";

    protected $table = "stored_children_ids";

    protected $fillable = [
        "card_number", "name", "gender", "family_card_number",
        "birthdate", "householder_name", "address", "religion", 
        "rt", "rw", "kelurahan", "kecamatan", "citizenship"
    ];

    public function reprintable()
    {
        return $this->morphMany(ReprintRequest::class, 'reprintable');
    }
}
