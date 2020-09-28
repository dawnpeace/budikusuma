<?php

namespace App;

use App\Traits\Statistic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChildIdSubmission extends Model
{
    use SoftDeletes, Statistic;

    protected $table = "child_id_submission";

    protected $fillable = [
        "card_number" ,"name", "gender", "birthplace", "birthdate", 
        "family_card_number", "householder_name", "religion",
        "birth_certificate_number", "citizenship", 
        "address", "rt", "rw", "kecamatan", "kelurahan", "status"
    ];

    protected $dates = [
        'birthdate'
    ];


}
