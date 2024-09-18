<?php

namespace App\Classes\DailySum;

use App\Interfaces\DailySum\GetPeriodDailySumInterface;
use App\Models\Closures;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class GetPeriodDailySum implements GetPeriodDailySumInterface
{
    public function getPeriodDailySum(string $day, ?string $begin = NULL, ?string $end = NULL): Collection
    {
        return Closures::whereBetween('closuredate', [is_null($begin) ? Closures::min('closuredate') : $begin, is_null($end) ? Closures::max('closuredate') : $end])
            ->selectRaw('sum(1) as db, sum(dailysum) as ossz')
            ->whereRaw('WEEKDAY(closuredate) =?', (Carbon::parse($day)->format('N') - 1))
            ->groupByRaw('DAYNAME(closuredate)')
            ->get();
    }
}
