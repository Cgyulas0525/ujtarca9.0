<?php

namespace App\Classes\DailySum;

use App\Interfaces\DailySum\GetDailySumInterface;
use App\Models\Closures;

class GetDailySum implements GetDailySumInterface
{
    public function getDailySum(string $date, ): int
    {
        $data = Closures::where('closuredate', $date)->first();
        return $data ? ($data->dailysum - 20000) : 0;
    }
}
