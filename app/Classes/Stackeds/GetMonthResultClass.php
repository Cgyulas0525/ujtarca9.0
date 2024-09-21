<?php

namespace App\Classes\Stackeds;

use App\Models\Monthstacked;

class GetMonthResultClass
{
    public function getMonthsResults(int $months): object
    {
        return Monthstacked::selectRaw('concat(CONCAT(year,"."), if(CAST(month AS UNSIGNED) < 10, concat("0", month), month)) as ym, revenue, spend, (revenue - spend) as amount')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get()
            ->take($months)
            ->sortBy('ym');
    }
}
