<?php

namespace App\Classes\Reports;

use App\Interfaces\Reports\MonthInvoicesResultInterface;
use App\Models\Invoices;
use App\Models\Closures;
use DB;

class MonthInvoicesResultClass implements MonthInvoicesResultInterface
{
    public function monthInvoicesResult(): object
    {
        $invoices = Invoices::selectRaw('concat(CONCAT(year(dated),"."), if(CAST(month(dated) AS UNSIGNED) < 10, concat("0", month(dated)), month(dated))) as nap, sum(amount) as amount, 0 as dailysum')
            ->whereBetween('dated', [now()->subYear()->toDateString(), now()->toDateString()])
            ->groupBy('nap');

        $closures = Closures::selectRaw('concat(CONCAT(year(closuredate),"."), if(CAST(month(closuredate) AS UNSIGNED) < 10, concat("0", month(closuredate)), month(closuredate))) as nap, 0 as amount, sum(dailysum - 20000) as dailysum')
            ->whereBetween('closuredate', [now()->subYear()->toDateString(), now()->toDateString()])
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
