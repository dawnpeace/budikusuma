<?php

namespace App;

use App\Traits\ClassName;
use App\Traits\Latest;
use App\Traits\Oldest;
use App\Traits\Reprintable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class IdentityCard extends Model
{

    use Reprintable, ClassName, Latest, Oldest;

    protected $table = "identity_cards";

    protected $dates = [ "birthdate" ];

    private $cardIdName = "identity_card_number";

    protected $fillable = [
        "identity_card_number", "name", "gender", "address",
        "birthplace", "birthdate", "rt", "rw", "kelurahan", "address",
        "kecamatan", "religion", "marriage_status", "profession", "nationality"
    ];

    public function reprintable()
    {
        return $this->morphMany(ReprintRequest::class, 'reprintable');
    }

    /**
     * @param String idCard
     * @return bool
     */
    public static function isIdExist($idCard)
    {
        return self::query()
            ->where('identity_card_number', $idCard)
            ->count() > 0;
    }

}
