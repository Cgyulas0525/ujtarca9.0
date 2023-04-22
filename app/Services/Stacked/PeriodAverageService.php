<?php

namespace App\Services\Stacked;

use App\Models\Weekstacked;

class PeriodAverageService
{
    public static function weekPeriodResultAverage($howmany, $withweek) {

        $number = 0;
        $average = 0;

        foreach (Weekstacked::where('id', '<', Weekstacked::get()->last()->id)->orderBy('year', 'desc')->orderBy('week', 'desc')->get()->take($howmany) as $data) {

            if ($data->weekofmonth == $withweek) {
                $average += $data->result;
                ++$number;
            }

        }

        return $number != 0 ? round($average / $number, 0, PHP_ROUND_HALF_UP) : 0;
    }
}
