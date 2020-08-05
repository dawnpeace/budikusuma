<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BirthCertificateSubmission extends Model
{
    protected $table = "birth_certificate_submission";

    protected $fillable = [
        "name", "gender", "mother_identity_card_number",
        "mother_name", "father_identity_card_number",
        "father_name", "birthdate", "birthplace"
    ];

    protected $dates =[
        "birthdate"
    ];
}
