<?php
namespace App\enums;

use App\IdentityCard;

class Document 
{

    const KTP = "E-KTP";
    const KK = "KK";
    const KIA = "KIA";
    const AKTA_LAHIR = "AKTA_LAHIR";
    const ALL = [
        self::KTP, self::KK, self::KIA, self::AKTA_LAHIR
    ];
    
}