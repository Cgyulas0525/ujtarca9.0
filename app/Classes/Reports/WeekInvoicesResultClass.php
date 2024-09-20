<?php

namespace App\Classes\Reports;

use App\Interfaces\Reports\WeekInvoicesResultInterface;
use App\Models\Invoices;
use App\Models\Closures;
use DB;

class WeekInvoicesResultClass implements WeekInvoicesResultInterface
{
    public function weekInvoicesResult(int $months = NULL): object
    {
        $begin = now()->subMonths($months ?? 6)->toDateString();
        $end = now()->toDateString();

        $invoices = Invoices::selectRaw('concat(CONCAT(year(dated),"."), if(CAST(week(dated, 1) AS UNSIGNED) < 10, concat("0", week(dated, 1)), week(dated, 1))) as nap, sum(amount) as amount, 0 as dailysum')
            ->whereBetween('dated', [$begin, $end])
            ->groupBy('nap');

        $closures = Closures::selectRaw('concat(CONCAT(year(closuredate),"."), if(CAST(week(closuredate, 1) AS UNSIGNED) < 10, concat("0", week(closuredate, 1)), week(closuredate, 1))) as nap, 0 as amount, sum(dailysum - 20000) as dailysum')
            ->whereBetween('closuredate', [$begin, $end])
            ->groupBy('nap')
            ->union($invoices);

        return DB::query()->fromSub($closures, 'p_pn')
            ->select('nap', DB::raw('ROUND( SUM(amount), 0) as elso,
                                                    ROUND( SUM(dailysum), 0) as masodik'))
            ->groupBy('nap')
            ->orderBy('nap', 'asc')
            ->get();
    }

}
