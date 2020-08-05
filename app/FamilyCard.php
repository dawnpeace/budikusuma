<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyCard extends Model
{
    protected $table = "stored_family_cards";

    public function reprintable()
    {
        return $this->morphMany(ReprintRequest::class, 'reprintable');
    }
}
