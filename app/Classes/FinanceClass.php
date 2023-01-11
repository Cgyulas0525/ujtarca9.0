<?php

namespace App\Classes;

use DB;

class FinanceClass
{

    private $year = [];
    private $sum;

    public function __construct($year) {
        $this->year = $year;
        $this->sum = 0;
    }

    public function closuresAmountSumYear() {
        return DB::table('closures as t1')
            ->select(DB::raw('sum(t1.dailysum - 20000) as dailysum'))
            ->whereNull('t1.deleted_at')
            ->whereIn(DB::raw('year(t1.closuredate)'), $this->year )
            ->get();
    }

    public function invoicesAmountSumYear() {
        return DB::table('invoices')
                   ->whereNull('deleted_at')
                   ->whereIn(DB::raw('year(dated)'), $this->year)
                   ->get()
                   ->sum('amount');
    }

}
