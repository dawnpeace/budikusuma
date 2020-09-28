<?php
namespace App\Traits;

use App\enums\DocumentStatus;
use Carbon\Carbon;

/**
 * Make sure to add published_at column to the table
 */
trait Statistic {

    public static function getStats(){

        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');

        $rejectedCount = static::query()
            ->where('status', DocumentStatus::REJECTED)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();

        $finishedCount = static::query()
            ->where('status', DocumentStatus::DONE)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();

        $progressCount = static::query()
            ->where('status', DocumentStatus::IN_PROGRESS)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();

        $totalCurrentMonth = static::query()
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();

        $totalRecorded = static::query()
            ->count();

        $totalPublished = static::query()
            ->where('status', DocumentStatus::DONE)
            ->count();
        
        return [
            "rejected" => $rejectedCount,
            "finished" => $finishedCount,
            "in_progress" => $progressCount,
            "monthly" => $totalCurrentMonth,
            "total_entry" => $totalRecorded,
            "total_published" => $totalPublished
        ];
    }
}