<?php

namespace App;

use App\Traits\ClassName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Statistic;
use App\Traits\Latest;
use App\Traits\Oldest;
use App\Traits\Publishable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class DeathCertificateSubmission extends Model implements HasMedia
{

    use SoftDeletes, Statistic, Latest, Oldest, Publishable, InteractsWithMedia;

    protected $table = "death_certificate_submission";

    protected $dates = [
        "published_at", "deceased_at", "birthdate"
    ];

    protected $fillable = [
        "name", "card_number", "identity_card",
        "note", "gender", "birthdate", "deceased_at",
        "published_at", "birthplace", "user_id", "status",
        "reason"
    ];

    protected static $selfIdName = "card_number";

    protected static $publishIdName = "card_number";

    protected static function getTargetClass()
    {
        return DeathCertificate::getClassName();
    }

}
