<?php

namespace App\Classes;

use DB;
use function PHPUnit\Framework\isNull;

class FinancePeriodClass
{

    private $begin;
    private $end;

    public function __construct($begin, $end) {
        $this->begin = $begin;
        $this->end = $end;
    }

    public function invoicesAmountPeriod() {
        $data = DB::table('invoices')
            ->select(DB::raw('sum(amount) as amount'))
            ->whereNull('deleted_at')
            ->whereBetween('dated', [$this->begin, $this->end])
            ->get();

        return isset($data->first()->amount) ? $data->first()->amount : 0;
    }

    public function closuresAmountPeriod() {
        $data = DB::table('closures as t1')
            ->select(DB::raw('sum(t1.dailysum - 20000) as dailysum'))
            ->whereNull('t1.deleted_at')
            ->whereBetween('t1.closuredate', [$this->begin , $this->end] )
            ->get();

        return isset($data->first()->dailysum) ? $data->first()->dailysum : 0;
    }

    public function resultPeriod() {
        return $this->closuresAmountPeriod() - $this->invoicesAmountPeriod();
    }

    public function yearInviocesPeriod() {
        return DB::table('invoices')
            ->select(DB::raw('year(dated) as year, sum(amount) as amount'))
            ->whereNull('deleted_at')
            ->whereBetween('dated', [$this->begin, $this->end])
            ->groupBy('year')
            ->orderBy('year')
            ->get();
    }

    public function yearClosuresPeriod() {
        return DB::table('closures as t1')
            ->select(DB::raw('year(t1.closuredate) as year, sum(t1.dailysum - 20000) as dailysum'))
            ->whereNull('t1.deleted_at')
            ->whereBetween('t1.closuredate', [$this->begin , $this->end] )
            ->groupBy(DB::raw('year(t1.closuredate)'))
            ->orderBy(DB::raw('year(t1.closuredate)'))
            ->get();
    }

    public function mountInviocesPeriod() {
        return DB::table('invoices')
            ->select(DB::raw('concat(year(dated), if(CAST(month(dated) AS UNSIGNED) < 10, concat("0", month(dated)), month(dated))) as yearmonth, sum(amount) as amount'))
            ->whereNull('deleted_at')
            ->whereBetween('dated', [$this->begin, $this->end])
            ->groupBy('yearmonth')
            ->orderBy('yearmonth')
            ->get();
    }

    public function mounthClosuresPeriod() {
        return DB::table('closures as t1')
            ->select(DB::raw('concat(year(t1.closuredate), if(CAST(month(t1.closuredate) AS UNSIGNED) < 10, concat("0", month(t1.closuredate)), month(t1.closuredate))) as yearmonth, sum(t1.dailysum - 20000) as dailysum'))
            ->whereNull('t1.deleted_at')
            ->whereBetween('t1.closuredate', [$this->begin , $this->end] )
            ->groupBy('yearmonth')
            ->orderBy('yearmonth')
            ->get();
    }

    public function weekInviocesPeriod() {
        return DB::table('invoices')
            ->select(DB::raw('concat(year(dated), if(CAST(week(dated) AS UNSIGNED) < 10, concat("0", week(dated)), week(dated))) as yearweek, sum(amount) as amount'))
            ->whereNull('deleted_at')
            ->whereBetween('dated', [$this->begin, $this->end])
            ->groupBy('yearweek')
            ->orderBy('yearweek')
            ->get();
    }

    public function weekClosuresPeriod() {
        return DB::table('closures as t1')
            ->select(DB::raw('concat(year(t1.closuredate), if(CAST(week(t1.closuredate) AS UNSIGNED) < 10, concat("0", week(t1.closuredate)), week(t1.closuredate))) as yearweek, sum(t1.dailysum - 20000) as dailysum'))
            ->whereNull('t1.deleted_at')
            ->whereBetween('t1.closuredate', [$this->begin , $this->end] )
            ->groupBy('yearweek')
            ->orderBy('yearweek')
            ->get();
    }

    public function yearInviocesResult() {
        $invoices = DB::table('invoices')
            ->select(DB::raw('year(dated) as year, sum(amount) as amount, 0 as dailysum'))
            ->whereNull('deleted_at')
            ->whereBetween('dated', [$this->begin, $this->end])
            ->groupBy('year');

        $closures = DB::table('closures as t1')
            ->select(DB::raw('year(t1.closuredate) as year, 0 as amount, sum(t1.dailysum - 20000) as dailysum'))
            ->whereNull('t1.deleted_at')
            ->whereBetween('t1.closuredate', [$this->begin , $this->end] )
            ->groupBy('year')
            ->union($invoices);

        return DB::query()->fromSub($closures, 'p_pn')
            ->select('year', DB::raw('ROUND( SUM(amount), 0) as amount,
                                                    ROUND( SUM(dailysum), 0) as dailysum'))
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();
    }

    public function monthInviocesResult() {
        $invoices = DB::table('invoices')
            ->select(DB::raw('concat(CONCAT(year(dated),"."), if(CAST(month(dated) AS UNSIGNED) < 10, concat("0", month(dated)), month(dated))) as year, sum(amount) as amount, 0 as dailysum'))
            ->whereNull('deleted_at')
            ->whereBetween('dated', [$this->begin, $this->end])
            ->groupBy('year');

        $closures = DB::table('closures as t1')
            ->select(DB::raw('concat(CONCAT(year(t1.closuredate),"."), if(CAST(month(t1.closuredate) AS UNSIGNED) < 10, concat("0", month(t1.closuredate)), month(t1.closuredate))) as year, 0 as amount, sum(t1.dailysum - 20000) as dailysum'))
            ->whereNull('t1.deleted_at')
            ->whereBetween('t1.closuredate', [$this->begin , $this->end] )
            ->groupBy('year')
            ->union($invoices);

        return DB::query()->fromSub($closures, 'p_pn')
            ->select('year', DB::raw('ROUND( SUM(amount), 0) as amount,
                                                    ROUND( SUM(dailysum), 0) as dailysum'))
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();
    }

    public function weekInviocesResult() {

        // értékek a számlákból
        $invoices = DB::table('invoices')
            ->select(DB::raw('concat(year(dated), if(CAST(week(dated) AS UNSIGNED) < 10, concat("0", week(dated)), week(dated))) as year, sum(amount) as amount, 0 as dailysum'))
            ->whereNull('deleted_at')
            ->whereBetween('dated', [$this->begin, $this->end])
            ->groupBy('year');

        // értékek a zárásból + union szamla
        $closures = DB::table('closures as t1')
            ->select(DB::raw('concat(year(t1.closuredate), if(CAST(week(t1.closuredate) AS UNSIGNED) < 10, concat("0", week(t1.closuredate)), week(t1.closuredate))) as year, 0 as amount, sum(t1.dailysum - 20000) as dailysum'))
            ->whereNull('t1.deleted_at')
            ->whereBetween('t1.closuredate', [$this->begin , $this->end] )
            ->groupBy('year')
            ->union($invoices);

        // select az előzőből
        return DB::query()->fromSub($closures, 'p_pn')
            ->select('year', DB::raw('ROUND( SUM(amount), 0) as amount,
                                                    ROUND( SUM(dailysum), 0) as dailysum'))
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();
    }

}
