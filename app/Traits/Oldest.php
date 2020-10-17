<?php

namespace App\Traits;

use Carbon\Carbon;

trait Oldest {

    /**
     * @return Date newest recorded
     */
    public static function getOldestRecord()
    {
        $oldest = self::query()
            ->oldest()
            ->first();
        return $oldest
            ? Carbon::createFromFormat('Y-m-d H:i:s', $oldest->created_at)->format('Y-m-d')
            : Carbon::now()->format('Y-m-d');
    }
}