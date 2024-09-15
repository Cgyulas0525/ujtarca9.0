<?php

namespace App\Classes\DailySum;

use App\Interfaces\DailySum\GetPeriodAverageDailySumInterface;

class GetPeriodAverageDailySum extends GetPeriodDailySum implements GetPeriodAverageDailySumInterface
{
    public function getPeriodAverageDailySum(string $day, ?string $begin = NULL, ?string $end = NULL): int
    {
        $data = parent::getPeriodDailySum($day, $begin, $end);
        return count($data) > 0 ? Round($data[0]->ossz / (is_null($data[0]->db) ? 1 : $data[0]->db), 0) : 0;
    }
}
