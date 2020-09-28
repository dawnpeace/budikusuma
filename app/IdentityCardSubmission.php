<?php

namespace App;

use App\Traits\Statistic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IdentityCardSubmission extends Model
{
    use SoftDeletes, Statistic;

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
