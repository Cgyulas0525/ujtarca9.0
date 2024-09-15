<?php

namespace App\Interfaces\DailySum;

use Illuminate\Support\Collection;

interface GetPeriodDailySumInterface
{
    public function getPeriodDailySum(string $day, ?string $begin = NULL, ?string $end = NULL): Collection;
}
