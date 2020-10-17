<?php

namespace App\Traits;

use Carbon\Carbon;

trait Latest {

    /**
     * @return Date oldest recorded
     */
    public static function getLatestRecord()
    {
        $latest = self::query()
            ->latest()
            ->first();

        return $latest
            ? Carbon::createFromFormat('Y-m-d H:i:s', $latest->created_at)->format('Y-m-d')
            : Carbon::now()->format('Y-m-d');
    }

}