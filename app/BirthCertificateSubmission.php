<?php

namespace App;

use App\Traits\Publishable;
use App\Traits\Statistic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BirthCertificateSubmission extends Model
{
    use SoftDeletes, Statistic, Publishable;

    protected $table = "birth_certificate_submission";

    protected $fillable = [
        "id_card", "name", "gender", "mother_identity_card_number",
        "mother_name", "father_identity_card_number",
        "father_name", "birthdate", "birthplace", "id_card", "status"
    ];

    protected $dates =[
        "birthdate"
    ];

    protected static $selfIdName = "id_card";

    protected static $publishIdName = "id_card";

    protected static function getTargetClass()
    {
        return BirthCertificate::getClassName();
    }

}
