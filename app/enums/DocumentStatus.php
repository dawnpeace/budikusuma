<?php
namespace App\enums;

class DocumentStatus {

    const HOLD = "00";
    const IN_PROGRESS = "01";
    const APPROVED = "02";
    const REJECTED = "03";
    const DONE = "04";
    const STATUS_NOT_DONE = [
        self::HOLD, self::IN_PROGRESS, self::APPROVED, self::REJECTED
    ];
}