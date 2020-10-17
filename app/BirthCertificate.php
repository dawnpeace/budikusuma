<?php

namespace App;

use App\Traits\ClassName;
use App\Traits\Latest;
use App\Traits\Oldest;
use App\Traits\Reprintable;
use Illuminate\Database\Eloquent\Model;

class BirthCertificate extends Model
{
    use Reprintable, ClassName, Latest, Oldest;
    
    protected $cardIdName = "id_card";

    protected $fillable = [
        "name", "gender", "mother_identity_card_number",
        "mother_name", "father_identity_card_number",
        "father_name", "birthdate", "birthplace", "id_card"
    ];

    protected $dates = [
        "birthdate"
    ];

    public function reprintable()
    {
        return $this->morphMany(ReprintRequest::class, 'reprintable');
    }
}
