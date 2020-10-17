<?php

namespace App;

use App\Traits\Latest;
use App\Traits\Oldest;
use App\Traits\Publishable;
use App\Traits\Statistic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FamilyCardSubmission extends Model
{

    use SoftDeletes, Statistic, Latest, Oldest, Publishable;

    protected $table = "family_card_submissions";
    protected $fillable = [
        "id_number", "householder", "householder_id_card", "rt", "rw",
        "zipcode", "kelurahan", "kabupaten", "provinsi", "address", "kecamatan", "status"
    ];

    public function members()
    {
        return $this->hasMany(FamilyCardMemberSubmission::class, 'family_card_id');
    }

}
