<?php

namespace App\Classes\OwnClass;

use DB;
use App\Models\Closures;

class ClosuresClass
{
    public static function getDailySum($date) {
        $data = DB::table('closures')->whereNull('deleted_at')->where('closuredate', $date)->first();
        return !empty($data) ? $data->dailysum : 0;
    }

    public static function getPeriodDailySum($day, $begin = NULL, $end = NULL)
    {
        return DB::table('closures')
            ->select(DB::raw('sum(1) as db, sum(dailysum) as ossz'))
            ->where(DB::raw('WEEKDAY(closuredate)'), "=", $day->format('N'))
            ->whereNull('deleted_at')
            ->whereBetween('closuredate', [is_null($begin) ? Closures::min('closuredate') : $begin,
                                                  is_null($end) ? Closures::max('closuredate') : $end])
            ->groupBy(DB::raw('DAYNAME(closuredate)'))
            ->get();
    }

    public static function getPeriodAverageDailysum($day, $begin = NULL, $end = NULL)
    {
        $data = self::getPeriodDailySum($day, $begin, $end);
        return Round($data[0]->ossz / $data[0]->db, 0);
    }
}
