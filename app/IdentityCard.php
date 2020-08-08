<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;

class IdentityCard extends Model
{
    protected $table = "identity_cards";

    protected $dates = [ "birthdate" ];

    public static $MONTH_LIMIT = 2;

    protected $fillable = [
        "identity_card_number", "name", "gender", "address",
        "birthplace", "birthdate", "rt", "rw", "kelurahan",
        "kecamatan", "religion", "marriage_status", "profession", "nationality"
    ];

    public function reprintable()
    {
        return $this->morphMany(ReprintRequest::class, 'reprintable');
    }

    public function submitReprint()
    {
        $hasQueue = $this->reprintable()->whereNull('printed_at')->count() > 0;
        if($hasQueue) throw new Exception("Anda memiliki permintaan yang sedang diproses");

        $recentlyPrinted = $this->reprintable()
            ->whereRaw("DATE_SUB(printed_at, INTERVAL 60 DAY)")
            ->orderBy('printed_at','DESC')
            ->first();

        if(!is_null($recentlyPrinted)) throw new Exception("Anda telah memasukkan permintaan dalam Interval waktu 2 Bulan");

        return $this->reprintable()->create([
            'id_number' => $this->identity_card_number
        ]);
    }
}
