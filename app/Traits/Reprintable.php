<?php
namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Log;

trait Reprintable{

    public function submitReprint($idName = null)
    {
        if(is_null($idName)) {
           $idName = property_exists($this, 'cardIdName') ? $this->cardIdName : false; 
        }

        if(!$idName) throw new Exception("Id name Cannot be empty");

        $hasQueue = $this->reprintable()->whereNull('printed_at')->count() > 0;
        if ($hasQueue) throw new Exception("Anda memiliki permintaan yang sedang diproses");

        $recentlyPrinted = $this->reprintable()
            ->whereRaw("DATE_SUB(printed_at, INTERVAL 60 DAY)")
            ->orderBy('printed_at', 'DESC')
            ->first();

        if( !is_null($recentlyPrinted)) throw new Exception("Anda telah memasukkan permintaan dalam Interval waktu 2 Bulan");

        return $this->reprintable()->create([
            'id_number' => $this->{$idName}
        ]);
    }

}