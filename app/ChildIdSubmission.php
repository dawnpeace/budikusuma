<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildIdSubmission extends Model
{
    protected $table = "child_id_submission";

    protected $fillable = [
        "name", "gender", "birthplace", "birthdate", 
        "family_card_number", "householder_name", "religion",
        "birth_certificate_number", "citizenship", 
        "address", "rt", "rw", "kecamatan", "kelurahan","status"
    ];

    protected $dates = [
        'birthdate'
    ];


}
