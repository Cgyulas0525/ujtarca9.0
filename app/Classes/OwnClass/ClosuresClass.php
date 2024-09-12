<?php

namespace App\Classes\OwnClass;

use DB;
use App\Models\Closures;

class ClosuresClass
{
    public static function getDailySum($date): int
    {
        $data = Closures::where('closuredate', $date)->first();
        return $data ? ($data->dailysum - 20000) : 0;
    }

    public static function getPeriodDailySum($day, $begin = NULL, $end = NULL): object
    {
        return Closures::whereBetween('closuredate', [is_null($begin) ? Closures::min('closuredate') : $begin, is_null($end) ? Closures::max('closuredate') : $end])
            ->selectRaw('sum(1) as db, sum(dailysum) as ossz')
            ->whereRaw('WEEKDAY(closuredate) =?', ($day->format('N') - 1))
            ->groupByRaw('DAYNAME(closuredate)')
            ->get();
    }

    public static function getPeriodAverageDailySum($day, $begin = NULL, $end = NULL): int
    {
        $data = self::getPeriodDailySum($day, $begin, $end);
        return count($data) > 0 ? Round($data[0]->ossz / (is_null($data[0]->db) ? 1 : $data[0]->db), 0) : 0;
    }
}

