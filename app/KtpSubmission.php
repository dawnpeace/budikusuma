<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KtpSubmission extends Model
{

    protected $fillable = [
        "name", "gender", "birthplace", "birthdate", "address", "rt",
        "rw", "kelurahan", "kecamatan", "profession", "religion", 
        "marriage_status", "nationality", "status"
    ];

    protected $dates = [
        'birthdate'
    ];
}
