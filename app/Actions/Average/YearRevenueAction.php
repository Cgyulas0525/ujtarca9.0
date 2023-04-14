<?php

namespace App\Actions\Average;

use App\Classes\FinancePeriodClass;

class YearRevenueAction
{

    private $begin;
    private $end;
    private $fpc;

    public function __construct() {
        $this->begin = date('Y-m-d', strtotime('first day of january this year'));
        $this->end = date('Y-m-d', strtotime('today'));
        $this->fpc = new FinancePeriodClass($this->begin, $this->end);
    }

    public function handle() {
        return $this->fpc->yearClosuresPeriod();
    }
}
