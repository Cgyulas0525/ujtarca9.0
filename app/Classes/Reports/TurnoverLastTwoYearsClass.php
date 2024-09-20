<?php

namespace App\Classes\Reports;

use App\Interfaces\Reports\TurnoverLastTwoYearsInterface;
use App\Models\Closures;
use DB;

class TurnoverLastTwoYearsClass implements TurnoverLastTwoYearsInterface
{

    public function turnoverLastTwoYears(): object
    {
        $query1 = Closures::selectRaw('MONTH(closuredate) as honap, (dailysum - 20000) as elso, 0 as masodik')
            ->whereBetween('closuredate', [
                now()->subMonths(24)->firstOfMonth()->toDateString(),
                now()->subMonths(12)->lastOfMonth()->toDateString(),
            ]);

        $query2 = Closures::selectRaw('MONTH(closuredate) as honap, 0 as elso, (dailysum - 20000) as masodik')
            ->whereBetween('closuredate', [
                now()->subMonths(12)->firstOfMonth()->toDateString(),
                now()->toDateString(),
            ])
            ->union($query1);

        return DB::query()->fromSub($query2, 'p_pn')
            ->select('honap', DB::raw('ROUND( SUM(elso), 0) as elso,
                                                    ROUND( SUM(masodik), 0) as masodik'))
            ->groupBy('honap')
            ->get();
    }
}
