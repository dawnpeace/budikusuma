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

class ChildIdentityCard extends Model
{

    use Reprintable, ClassName, Latest, Oldest;

    protected $cardIdName = "card_number";

    protected $table = "stored_children_ids";

    protected $dates = [
        "birthdate"
    ];

    protected $fillable = [
        "card_number", "name", "gender", "family_card_number",
        "birthdate", "householder_name", "address", "religion", 
        "rt", "rw", "kelurahan", "kecamatan", "citizenship", "birthplace", "birth_certificate_number",
        "user_id"
    ];

    public function reprints()
    {
        return $this->morphMany(ReprintRequest::class, 'reprintable');
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
