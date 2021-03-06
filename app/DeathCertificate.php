<?php

namespace App;

use App\Traits\Latest;
use App\Traits\Oldest;
use App\Traits\ClassName;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class DeathCertificate extends Model implements HasMedia
{
    use Latest, Oldest, ClassName, InteractsWithMedia;

    protected $dates = [
        "published_at", "deceased_at", "birthdate"
    ];

    protected $fillable = [
        "name", "card_number", "identity_card", "note", "gender", "birthdate", "deceased_at", "published_at", "birthplace", "user_id", "status"
    ];

    public function reprints()
    {
        return $this->morphMany(ReprintRequest::class, 'reprintable');
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
            "id_number" => $this->card_number,
            "user_id" => $authId
        ]);
    }

}
