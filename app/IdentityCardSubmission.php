<?php

namespace App;

use App\Traits\Publishable;
use App\Traits\Statistic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class IdentityCardSubmission extends Model implements HasMedia
{
    use SoftDeletes, Statistic, Publishable, InteractsWithMedia;

    protected $table = 'identity_card_submissions';

    protected static $selfIdName = "id_card";

    protected static $publishIdName = "identity_card_number";

    protected static function getTargetClass()
    {
        return IdentityCard::getClassName();
    }

    protected $fillable = [
        "name", "gender", "birthplace", "birthdate", "address", "rt",
        "rw", "kelurahan", "kecamatan", "profession", "religion",
        "marriage_status", "nationality", "status", "id_card",
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
