<?php

namespace App\Services;

use DB;
use App\Models\Closures;

class ClosuresService
{
    public static function getDailySum($date)
    {
        $data = Closures::firstwhere('closuredate', $date);
        return !empty($data) ? ($data->dailysum - 20000) : 0;
    }

    public static function getPeriodDailySum($day, $begin = NULL, $end = NULL)
    {
        return DB::table('closures')
            ->where(DB::raw('WEEKDAY(closuredate)'), "=", ($day->format('N') - 1))
            ->whereNull('deleted_at')
            ->whereBetween('closuredate', [is_null($begin) ? Closures::min('closuredate') : $begin,
                is_null($end) ? Closures::max('closuredate') : $end])
            ->get();
    }

    public static function getPeriodAverageDailysum($day, $begin = NULL, $end = NULL)
    {
        $data = self::getPeriodDailySum($day, $begin, $end);
        return count($data) > 0 ? Round($data->average('dailysum'), 0) - 20000 : 0;
    }
}

