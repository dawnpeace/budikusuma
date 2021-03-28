<?php
namespace App\enums;

use App\IdentityCard;

class Document 
{

    const KTP = "E-KTP";
    const KK = "KK";
    const KIA = "KIA";
    const AKTA_LAHIR = "AKTA_LAHIR";
    const AKTA_KEMATIAN = "AKTA_KEMATIAN";
    const ALL = [
        self::KTP, self::KK, self::KIA, self::AKTA_LAHIR, self::AKTA_KEMATIAN
    ];
    
}