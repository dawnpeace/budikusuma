<?php

namespace App;

use App\Traits\Latest;
use App\Traits\Oldest;
use App\Traits\Publishable;
use App\Traits\Statistic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ChildIdSubmission extends Model implements HasMedia
{
    use SoftDeletes, Statistic, Publishable, InteractsWithMedia;

    protected $table = "child_id_submission";

    protected static $selfIdName = "card_number";

    protected static $publishIdName = "card_number";

    protected static function getTargetClass()
    {
        return ChildIdentityCard::getClassName();
    }

    protected $fillable = [
        "card_number", "name", "gender", "birthplace", "birthdate",
        "family_card_number", "householder_name", "religion",
        "birth_certificate_number", "citizenship",
        "address", "rt", "rw", "kecamatan", "kelurahan", "status",
        "user_id", "reason", "type"
    ];

    protected $dates = [
        'birthdate'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
