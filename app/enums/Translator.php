<?php

namespace App\enums;

use App\enums\MarriageStatus;

class Translator 
{

    public static function marriageStatus($key)
    {
        if ( in_array($key, MarriageStatus::ALL) ) {
            $status = [
                MarriageStatus::MARRIED => 'Kawin',
                MarriageStatus::NOT_MARRIED => 'Belum Kawin',
                MarriageStatus::WIDOWER => 'Cerai'
            ];

            return $status[$key];
        }
        return '';
    }
}