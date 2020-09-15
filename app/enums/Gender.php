<?php

namespace App\enums;

class Gender 
{
    const MAN = "laki-laki";
    const WOMAN = "perempuan";
    const ALL = [
        self::MAN, self::WOMAN
    ];
}