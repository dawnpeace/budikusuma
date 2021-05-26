<?php

namespace App;

use App\Traits\Latest;
use App\Traits\Oldest;
use App\Traits\Publishable;
use App\Traits\Statistic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChildIdSubmission extends Model
{
    use SoftDeletes, Statistic, Publishable;

    protected $table = "child_id_submission";

    protected static $selfIdName = "card_number";

    protected static $publishIdName = "card_number";

    protected static function getTargetClass()
    {
        return ChildIdentityCard::getClassName();
    }

    protected $fillable = [
        "card_number" ,"name", "gender", "birthplace", "birthdate", 
        "family_card_number", "householder_name", "religion",
        "birth_certificate_number", "citizenship", 
        "address", "rt", "rw", "kecamatan", "kelurahan", "status",
        "user_id", "reason"
    ];

    protected $dates = [
        'birthdate'
    ];


}
