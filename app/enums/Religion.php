<?php

namespace App\enums;

class Religion 
{
    const ISLAM = "islam";
    const PROTESTANT = "kristen protestan";
    const KATOLIK = "kristen katolik";
    const BUDDHA = "buddha";
    const KONGHUCU = "konghucu";
    CONST HINDU = "hindu";

    const ALL = [
        self::ISLAM, self::PROTESTANT, self::KATOLIK, self::BUDDHA, self::KONGHUCU, self::HINDU
    ];
}