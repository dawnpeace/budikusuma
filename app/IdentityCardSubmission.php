<?php

namespace App;

use App\Traits\Publishable;
use App\Traits\Statistic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class IdentityCardSubmission extends Model
{
    use SoftDeletes, Statistic, Publishable;

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
        "marriage_status", "nationality", "status", "id_card"
    ];

    protected $dates = [
        'birthdate'
    ];

    // public function publish()
    // {
    //     DB::transaction(function(){
    //         if( !IdentityCard::isIdExist($this->id_card) ) {
    //             $data = $this->toArray();
    //             $data["identity_card_number"] = $this->id_card;
    //             IdentityCard::create($data);
    //             $this->published_at = now();
    //             $this->save();
    //         } else {
    //             throw new \Exception("Id Exist");
    //         }
    //     });
    // }

}
