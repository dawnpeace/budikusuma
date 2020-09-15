<?php

namespace App\enums;

class MarriageStatus 
{
    const MARRIED = "married";
    const NOT_MARRIED = "not_married";
    const WIDOWER = "WIDOWER";
    const ALL = [
        self::MARRIED, self::NOT_MARRIED, self::WIDOWER
    ];
}