<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdentityCardSubmission extends Model
{
    protected $table = 'identity_card_submissions';

    protected $fillable = [
        "name", "gender", "birthplace", "birthdate", "address", "rt",
        "rw", "kelurahan", "kecamatan", "profession", "religion",
        "marriage_status", "nationality", "status"
    ];

    protected $dates = [
        'birthdate'
    ];
}
