<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BirthCertificateSubmission extends Model
{
    use SoftDeletes;

    protected $table = "birth_certificate_submission";

    protected $fillable = [
        "name", "gender", "mother_identity_card_number",
        "mother_name", "father_identity_card_number",
        "father_name", "birthdate", "birthplace", "id_card"
    ];

    protected $dates =[
        "birthdate"
    ];
}
