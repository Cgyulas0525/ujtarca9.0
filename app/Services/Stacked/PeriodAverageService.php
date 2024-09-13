<?php

namespace App\Services\Stacked;

use App\Models\Weekstacked;
use \Carbon\Carbon;

class PeriodAverageService
{
    public static function weekPeriodResultAverage(int $howmany, int $withweek): array
    {
        $date = new \DateTime;
        $resultArray = ['revenue' => 0, 'spend' => 0, 'result' => 0, 'number' => 0];
        foreach (Weekstacked::where('id', '<', Weekstacked::get()->last()->id)->orderBy('year', 'desc')->orderBy('week', 'desc')->get()->take($howmany) as $data) {
            $date = $date->setISODate($data->year, $data->week);
            $week = Carbon::parse($date->format('Y-m-d'));
            if ($week->weekOfMonth == $withweek) {
                $resultArray['result'] += $data->result;
                $resultArray['revenue'] += $data->revenue;
                $resultArray['spend'] += $data->spend;
                ++$resultArray['number'];
            }
        }
        return $resultArray;
    }
}
