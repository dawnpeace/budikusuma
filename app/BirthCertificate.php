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
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class BirthCertificate extends Model implements HasMedia
{
    use Reprintable, ClassName, Latest, Oldest, InteractsWithMedia;

    protected $cardIdName = "id_card";

    protected $fillable = [
        "name", "gender", "mother_identity_card_number",
        "mother_name", "father_identity_card_number",
        "father_name", "birthdate", "birthplace", "id_card",
        "user_id"
    ];

    protected $dates = [
        "birthdate"
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
        })
            ->where('user_id', Auth::id())
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
