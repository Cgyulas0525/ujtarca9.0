<?php

namespace App\Classes;

use DB;
use App\Models\Closures;
use App\Models\Invoices;

class RiportsClass
{
    public static function TurnoverLast30Days(): object
    {
        return Closures::selectRaw('closuredate as nap, (dailysum - 20000) as osszeg',)
            ->whereBetween('closuredate', [now()->subDays(30)->toDateString(), now()->toDateString()])
            ->get();
    }

    public static function TurnoverLast26Weeks(): object
    {
        return Closures::selectRaw('concat(CONCAT(year(closuredate),"."), if(CAST(week(closuredate, 1) AS UNSIGNED) < 10, concat("0", week(closuredate, 1)), week(closuredate, 1))) as nap, sum(dailysum - 20000) as osszeg')
            ->whereBetween('closuredate', [now()->subWeeks(26)->toDateString(), now()->toDateString()])
            ->groupBy('nap')
            ->orderBy('nap')
            ->get();
    }

    public static function TurnoverLast12Month(): object
    {
        return Closures::selectRaw('concat(CONCAT(year(closuredate),"."), if(CAST(month(closuredate) AS UNSIGNED) < 10, concat("0", month(closuredate)), month(closuredate))) as nap, sum(dailysum - 20000) as osszeg')
            ->whereBetween('closuredate', [now()->subMonths(12)->toDateString(), now()->toDateString()])
            ->groupBy('nap')
            ->orderBy('nap')
            ->get();
    }

    public static function PaymentMethodLast30days(): object
    {
        return Closures::selectRaw('closuredate as nap, card, szcard, (dailysum  - (card + szcard + 20000)) as dayCash')
            ->whereBetween('closuredate', [now()->subDays(30)->toDateString(), now()->toDateString()])
            ->get();
    }

    public static function TurnoverLastTwoYears(): object
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

    public static function monthInvoicesResult(): object
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

    public static function weekInvoicesResult($months = NULL): object
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

    public function daysInvoicesResult(?string $begin = NULL, ?string $end = NULL): object
    {
        $begin = $begin ?? Closures::orderBy('closuredate', 'asc')->first()->closuredate->toDateString();
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

