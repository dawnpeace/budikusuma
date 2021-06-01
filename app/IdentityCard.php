<?php

namespace App;

use App\Traits\ClassName;
use App\Traits\Latest;
use App\Traits\Oldest;
use App\Traits\Reprintable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class IdentityCard extends Model implements HasMedia
{

    use Reprintable, ClassName, Latest, Oldest, InteractsWithMedia;

    protected $table = "identity_cards";

    protected $dates = [ "birthdate" ];

    private $cardIdName = "identity_card_number";

    protected $fillable = [
        "identity_card_number", "name", "gender", "address",
        "birthplace", "birthdate", "rt", "rw", "kelurahan", "address",
        "kecamatan", "religion", "marriage_status", "profession", "nationality",
        "user_id"
    ];

    public function reprints()
    {
        return $this->morphMany(ReprintRequest::class, 'reprintable');
    }

    public function createReprint($authId)
    {
        return $this->reprints()->create([
            "id_number" => $this->identity_card_number,
            "user_id" => $authId
        ]);
    }

    public static function hasJustPrinted()
    {
        return self::whereHas('reprints', function(Builder $builder) {
                $builder->whereBetween('created_at', [Carbon::now()->addMonths(-2), Carbon::now()]);
            })
            ->where('user_id', Auth::id())
            ->count();
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
