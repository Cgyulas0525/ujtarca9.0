<?php

namespace App\Classes;

use DB;

class ClosuresClass
{
    private $begin;
    private $end;

    public function __construct($begin, $end) {
        $this->begin = $begin;
        $this->end = $end;
    }

    public function closuresPeriod() {
        return DB::table('closures')
                 ->whereNull('deleted_at')
                 ->whereBetween('closuredate', [$this->begin, $this->end])
                 ->get();
    }

    public function cashPeriod() {
        $data = DB::table('closures')
            ->select(DB::raw('sum(dailysum - (card + szcard + 20000)) as cash'))
            ->whereNull('deleted_at')
            ->whereBetween('closuredate', [$this->begin, $this->end])
            ->get();

        return $data[0]->cash;
    }

    public function cardPeriod() {
        return DB::table('closures')
            ->whereNull('deleted_at')
            ->whereBetween('closuredate', [$this->begin, $this->end])
            ->get()->sum('card');
    }

    public function szcardPeriod() {
        return DB::table('closures')
            ->whereNull('deleted_at')
            ->whereBetween('closuredate', [$this->begin, $this->end])
            ->get()->sum('szcard');
    }

    public function averigePeriod() {
        $data = DB::table('closures')
            ->select(DB::raw('sum(1) as day, sum(dailysum - 20000) as sum'))
            ->whereNull('deleted_at')
            ->whereBetween('closuredate', [$this->begin, $this->end])
            ->get();

        return Round($data[0]->sum / $data[0]->day, 0);

    }
}
