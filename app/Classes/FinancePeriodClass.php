<?php

namespace App\Classes;

use DB;
use App\Models\Closures;
use App\Models\Invoices;

class FinancePeriodClass
{

    private $begin;
    private $end;

    public function __construct($begin, $end)
    {
        $this->begin = $begin;
        $this->end = $end;
    }

    public function invoicesAmountPeriod(): int
    {
        return Invoices::whereBetween('dated', [$this->begin, $this->end])
            ->get()
            ->sum('amount');
    }

    public function closuresAmountPeriod(): int
    {
        return Closures::whereBetween('closuredate', [$this->begin, $this->end])
                ->selectRaw('sum(dailysum - 20000) as dailysum')
                ->get()
                ->first()
                ->dailysum ?? 0;
    }

    public function resultPeriod(): int
    {
        return $this->closuresAmountPeriod() - $this->invoicesAmountPeriod();
    }

    public function yearInvoicesPeriod(): object
    {
        return Invoices::selectRaw('year(dated) as year, sum(amount) as amount')
            ->whereBetween('dated', [$this->begin, $this->end])
            ->groupBy('year')
            ->orderBy('year')
            ->get();
    }

    public function yearClosuresPeriod(): object
    {
        return Closures::selectRaw('year(closuredate) as year,
                    sum(dailysum - 20000) as dailysum,
                    sum(1) as days,
                    sum(card) as card,
                    sum(szcard) as szcard')
            ->whereBetween('closuredate', [$this->begin, $this->end])
            ->groupBy('year')
            ->orderBy('year')
            ->get();
    }

    public function mountInvoicesPeriod(): object
    {
        return Invoices::selectRaw('concat(year(dated), if(CAST(month(dated) AS UNSIGNED) < 10, concat("0", month(dated)), month(dated))) as yearmonth, sum(amount) as amount')
            ->whereBetween('dated', [$this->begin, $this->end])
            ->groupBy('yearmonth')
            ->orderBy('yearmonth')
            ->get();
    }

    public function mountClosuresPeriod(): object
    {
        return Closures::selectRaw('concat(year(closuredate), if(CAST(month(closuredate) AS UNSIGNED) < 10, concat("0", month(closuredate)), month(closuredate))) as yearmonth,
                    sum(dailysum - 20000) as dailysum,
                    sum(1) as days,
                    sum(card) as card,
                    sum(szcard) as szcard')
            ->whereBetween('closuredate', [$this->begin, $this->end])
            ->groupBy('yearmonth')
            ->orderBy('yearmonth')
            ->get();
    }

    public function weekInvoicesPeriod(): object
    {
        return Invoices::selectRaw('concat(year(dated), if(CAST(week(dated, 1) AS UNSIGNED) < 10, concat("0", week(dated, 1)), week(dated, 1))) as yearweek, sum(amount) as amount')
            ->whereBetween('dated', [$this->begin, $this->end])
            ->groupBy('yearweek')
            ->orderBy('yearweek')
            ->get();
    }

    public function weekClosuresPeriod(): object
    {
        return Closures::selectRaw('concat(year(closuredate), if(CAST(week(closuredate, 1) AS UNSIGNED) < 10, concat("0", week(closuredate, 1)), week(closuredate, 1))) as yearweek,
                    sum(dailysum - 20000) as dailysum,
                    sum(1) as days,
                    sum(card) as card,
                    sum(szcard) as szcard')
            ->whereBetween('closuredate', [$this->begin, $this->end])
            ->groupBy('yearweek')
            ->orderBy('yearweek')
            ->get();
    }

    public function yearInvoicesResult(): object
    {
        $invoices = DB::table('invoices')
            ->select(DB::raw('year(dated) as year, sum(amount) as amount, 0 as dailysum'))
            ->whereNull('deleted_at')
            ->whereBetween('dated', [$this->begin, $this->end])
            ->groupBy('year');

        $closures = DB::table('closures')
            ->select(DB::raw('year(closuredate) as year, 0 as amount, sum(dailysum - 20000) as dailysum'))
            ->whereNull('deleted_at')
            ->whereBetween('closuredate', [$this->begin, $this->end])
            ->groupBy('year')
            ->union($invoices);

        return DB::query()->fromSub($closures, 'p_pn')
            ->select('year', DB::raw('ROUND( SUM(amount), 0) as amount,
                                                    ROUND( SUM(dailysum), 0) as dailysum'))
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();
    }

    public function monthInvoicesResult(): object
    {
        $invoices = DB::table('invoices')
            ->select(DB::raw('concat(CONCAT(year(dated),"."), if(CAST(month(dated) AS UNSIGNED) < 10, concat("0", month(dated)), month(dated))) as year, sum(amount) as amount, 0 as dailysum'))
            ->whereNull('deleted_at')
            ->whereBetween('dated', [$this->begin, $this->end])
            ->groupBy('year');

        $closures = DB::table('closures')
            ->select(DB::raw('concat(CONCAT(year(closuredate),"."), if(CAST(month(closuredate) AS UNSIGNED) < 10, concat("0", month(closuredate)), month(closuredate))) as year, 0 as amount, sum(dailysum - 20000) as dailysum'))
            ->whereNull('deleted_at')
            ->whereBetween('closuredate', [$this->begin, $this->end])
            ->groupBy('year')
            ->union($invoices);

        return DB::query()->fromSub($closures, 'p_pn')
            ->select('year', DB::raw('ROUND( SUM(amount), 0) as amount,
                                                    ROUND( SUM(dailysum), 0) as dailysum'))
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();
    }

    public function weekInvoicesResult(): object
    {

        $invoices = DB::table('invoices')
            ->select(DB::raw('concat(year(dated), if(CAST(week(dated, 1) AS UNSIGNED) < 10, concat("0", week(dated, 1)), week(dated, 1))) as year, sum(amount) as amount, 0 as dailysum'))
            ->whereNull('deleted_at')
            ->whereBetween('dated', [$this->begin, $this->end])
            ->groupBy('year');

        $closures = DB::table('closures')
            ->select(DB::raw('concat(year(closuredate), if(CAST(week(closuredate, 1) AS UNSIGNED) < 10, concat("0", week(closuredate, 1)), week(closuredate, 1))) as year, 0 as amount, sum(dailysum - 20000) as dailysum'))
            ->whereNull('deleted_at')
            ->whereBetween('closuredate', [$this->begin, $this->end])
            ->groupBy('year')
            ->union($invoices);

        return DB::query()->fromSub($closures, 'p_pn')
            ->select('year', DB::raw('ROUND( SUM(amount), 0) as amount,
                                                    ROUND( SUM(dailysum), 0) as dailysum'))
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();
    }
}
