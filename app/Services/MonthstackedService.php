<?php

namespace App\Services;

use App\Models\Monthstacked;

class MonthstackedService
{

    public function getLastYear() {

        return Monthstacked::orderBy('year', 'desc')->orderBy('month', 'desc')->get()->take(12);

    }

    public function getSumPercent($field) {

        return Round($this->getLastYear()->sum($field) / ($this->getLastYear()->sum('revenue') / 100), 0);

    }

    public function getMonthsResults($months) {

        return Monthstacked::selectRaw('concat(CONCAT(year,"."), if(CAST(month AS UNSIGNED) < 10, concat("0", month), month)) as ym, revenue, spend, (revenue - spend) as amount')
                            ->orderBy('year', 'desc')
                            ->orderBy('month', 'desc')
                            ->get()
                            ->take($months)
                            ->sortBy('ym');
    }

}
