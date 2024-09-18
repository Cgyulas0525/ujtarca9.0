<?php

namespace App\Interfaces\DailySum;

interface GetPeriodAverageDailySumInterface
{
    public function getPeriodAverageDailySum(string $day, ?string $begin = NULL, ?string $end = NULL): int;
}
