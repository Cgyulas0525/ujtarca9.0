<?php

namespace App\Classes\Reports;

use App\Interfaces\Reports\DaysInvoicesResultInterface;
use App\Models\Invoices;
use App\Models\Closures;
use DB;

class DaysInvoicesResultClass implements DaysInvoicesResultInterface
{
    public function daysInvoicesResult(?string $begin = NULL, ?string $end = NULL): object
    {
        $begin = $begin ?? optional(
            Closures::orderBy('closuredate', 'asc')->first()
        )->closuredate?->toDateString();
        $end = $end ?? now()->toDateString();

        $invoices = Invoices::selectRaw('dated as nap, sum(amount) as amount, 0 as dailysum')
            ->whereBetween('dated', [$begin, $end])
            ->groupBy('nap');

        $closures = Closures::selectRaw('closuredate as nap, 0 as amount, sum(dailysum - 20000) as dailysum')
            ->whereBetween('closuredate', [$begin, $end])
            ->groupBy('nap')
            ->union($invoices);

        return DB::query()->fromSub($closures, 'p_pn')
            ->select('nap', DB::raw('ROUND( SUM(amount), 0) as kiadas,
                                                  ROUND( SUM(dailysum), 0) as bevetel,
                                                  ROUND( SUM(dailysum - amount), 0) as eredmeny'))
            ->groupBy('nap')
            ->orderBy('nap', 'asc')
            ->get();
    }
}
