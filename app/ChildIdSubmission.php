<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildIdSubmission extends Model
{
    protected $table = "child_id_submission";

    protected $fillable = [
        "name", "family_card_number", "birthdate", "mother_identity_card_number",
        "father_identity_card_number", "status"
    ];

    protected $dates = [
        'birthdate'
    ];


}
