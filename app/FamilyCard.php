<?php

namespace App;

use App\Traits\CheckNaturalId;
use App\Traits\ClassName;
use App\Traits\Latest;
use App\Traits\Oldest;
use App\Traits\Reprintable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class FamilyCard extends Model implements HasMedia
{
    use Reprintable, ClassName, Oldest, Latest, InteractsWithMedia;

    protected $table = "stored_family_cards";

    protected $fillable = [
        "id_card", "householder", "householder_id_card", "rt", "rw", "zip_code", "kelurahan", "kabupaten",
        "kecamatan", "provinsi", "address", "user_id"
    ];

    private $cardIdName = "id_card";

    public function reprints()
    {
        return $this->morphMany(ReprintRequest::class, 'reprintable');
    }

    public function members()
    {
        return $this->hasMany(FamilyCardMember::class, 'family_card_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public static function hasJustPrinted()
    {
        return self::whereHas('reprints', function (Builder $builder) {
            $builder->whereBetween('created_at', [Carbon::now()->addMonths(-2), Carbon::now()]);
        })->where('user_id', Auth::id())
        ->count();
    }

    public function createReprint($authId)
    {
        return $this->reprints()->create([
            "id_number" => $this->id_card,
            "user_id" => $authId
        ]);
    }
}
