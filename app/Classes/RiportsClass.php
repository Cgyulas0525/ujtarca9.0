<?php

namespace App\Classes;

use DB;
use App\Classes\FinancePeriodClass;
use App\Models\Closures;

class RiportsClass
{

    public static function TurnoverLast30Days() {

        $begin = date('Y-m-d', strtotime('-30 day'));
        $end = date('Y-m-d', strtotime('today'));

        return Closures::selectRaw('closuredate as nap, (dailysum - 20000) as osszeg', )->whereBetween('closuredate', [$begin, $end])->get();
    }

    public static function TurnoverLast26Weeks() {

        $begin = date('Y-m-d', strtotime('-26 week'));
        $end = date('Y-m-d', strtotime('today'));

        return DB::table('closures')
            ->select(DB::raw('concat(CONCAT(year(closuredate),"."), if(CAST(week(closuredate) AS UNSIGNED) < 10, concat("0", week(closuredate)), week(closuredate))) as nap, sum(dailysum - 20000) as osszeg'))
            ->whereNull('deleted_at')
            ->whereBetween('closuredate', [$begin, $end])
            ->groupBy('nap')
            ->orderBy('nap')
            ->get();

    }

    public static function TurnoverLast12Month() {

        $begin = date('Y-m-d', strtotime('-12 month'));
        $end = date('Y-m-d', strtotime('today'));

        return DB::table('closures')
            ->select(DB::raw('concat(CONCAT(year(closuredate),"."), if(CAST(month(closuredate) AS UNSIGNED) < 10, concat("0", month(closuredate)), month(closuredate))) as nap, sum(dailysum - 20000) as osszeg'))
            ->whereNull('deleted_at')
            ->whereBetween('closuredate', [$begin, $end])
            ->groupBy('nap')
            ->orderBy('nap')
            ->get();

    }

    public static function PaymentMethodLast30days() {

        $begin = date('Y-m-d', strtotime('-30 day'));
        $end = date('Y-m-d', strtotime('today'));

        return DB::table('closures')
            ->select(DB::raw('closuredate as nap, card, szcard, (dailysum  - ( card + szcard + 20000)) as cash'))
            ->whereNull('deleted_at')
            ->whereBetween('closuredate', [$begin, $end])
            ->get();

    }

    public static function TurnoverLastTwoYears() {

        $query1 = DB::table('closures as t')
            ->select(DB::raw('month(t.closuredate) as honap, (dailysum - 20000) as elso, 0 as masodik'))
            ->whereBetween('t.closuredate', [date('Y-m-d', strtotime('first day this month - 24 month')),
                date('Y-m-d', strtotime('last day this month - 12 month'))]);

        $query2 = DB::table('closures as t')
            ->select(DB::raw('month(t.closuredate) as honap, 0 as elso,  (dailysum - 20000) as masodik'))
            ->whereBetween('t.closuredate', [date('Y-m-d', strtotime('first day this month - 12 month')),
                date('Y-m-d', strtotime('today'))])
            ->union($query1);

        return DB::query()->fromSub($query2, 'p_pn')
            ->select('honap', DB::raw('ROUND( SUM(elso), 0) as elso,
                                                    ROUND( SUM(masodik), 0) as masodik'))
            ->groupBy('honap')
            ->get();

    }

    public static function monthInviocesResult() {

       $begin = date('Y-m-d', strtotime('today -1 year'));
       $end   = date('Y-m-d', strtotime('today'));

        $invoices = DB::table('invoices')
            ->select(DB::raw('concat(CONCAT(year(dated),"."), if(CAST(month(dated) AS UNSIGNED) < 10, concat("0", month(dated)), month(dated))) as nap, sum(amount) as amount, 0 as dailysum'))
            ->whereNull('deleted_at')
            ->whereBetween('dated', [$begin, $end])
            ->groupBy('nap');

        $closures = DB::table('closures as t1')
            ->select(DB::raw('concat(CONCAT(year(t1.closuredate),"."), if(CAST(month(t1.closuredate) AS UNSIGNED) < 10, concat("0", month(t1.closuredate)), month(t1.closuredate))) as nap, 0 as amount, sum(t1.dailysum - 20000) as dailysum'))
            ->whereNull('t1.deleted_at')
            ->whereBetween('t1.closuredate', [$begin , $end] )
            ->groupBy('nap')
            ->union($invoices);

        return DB::query()->fromSub($closures, 'p_pn')
            ->select('nap', DB::raw('ROUND( SUM(amount), 0) as elso,
                                                    ROUND( SUM(dailysum), 0) as masodik'))
            ->groupBy('nap')
            ->orderBy('nap', 'asc')
            ->get();


    }

    public static function weekInviocesResult($months = null) {

        $month = is_null($months) ? 6 : $months;
        $begin = date('Y-m-d', strtotime('today - '. $month . ' month'));
        $end   = date('Y-m-d', strtotime('today'));

        $invoices = DB::table('invoices')
            ->select(DB::raw('concat(CONCAT(year(dated),"."), if(CAST(week(dated) AS UNSIGNED) < 10, concat("0", week(dated)), week(dated))) as nap, sum(amount) as amount, 0 as dailysum'))
            ->whereNull('deleted_at')
            ->whereBetween('dated', [$begin, $end])
            ->groupBy('nap');

        $closures = DB::table('closures as t1')
            ->select(DB::raw('concat(CONCAT(year(t1.closuredate),"."), if(CAST(week(t1.closuredate) AS UNSIGNED) < 10, concat("0", week(t1.closuredate)), week(t1.closuredate))) as nap, 0 as amount, sum(t1.dailysum - 20000) as dailysum'))
            ->whereNull('t1.deleted_at')
            ->whereBetween('t1.closuredate', [$begin , $end] )
            ->groupBy('nap')
            ->union($invoices);

        return DB::query()->fromSub($closures, 'p_pn')
            ->select('nap', DB::raw('ROUND( SUM(amount), 0) as elso,
                                                    ROUND( SUM(dailysum), 0) as masodik'))
            ->groupBy('nap')
            ->orderBy('nap', 'asc')
            ->get();

    }

    public function daysInviocesResult($begin = null, $end = null) {

        $begin = is_null($begin) ? date('Y-m-d', strtotime(Closures::orderBy('closuredate', 'asc')->first()->closuredate)) : $begin;
        $end   = is_null($end) ? date('Y-m-d', strtotime('today')) : $end;

        $invoices = DB::table('invoices')
            ->select(DB::raw('dated as nap, sum(amount) as amount, 0 as dailysum'))
            ->whereNull('deleted_at')
            ->whereBetween('dated', [$begin, $end])
            ->groupBy('nap');

        $closures = DB::table('closures as t1')
            ->select(DB::raw('t1.closuredate as nap, 0 as amount, sum(t1.dailysum - 20000) as dailysum'))
            ->whereNull('t1.deleted_at')
            ->whereBetween('t1.closuredate', [$begin , $end] )
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

