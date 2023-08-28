<?php

namespace App\Actions\Average;

use App\Classes\FinancePeriodClass;

class WeekRevenueAction
{

    private $begin;
    private $end;
    private $fpc;

    public function __construct()
    {
        $this->begin = date('Y-m-d', strtotime('monday this week'));
        $this->end = date('Y-m-d', strtotime('today'));
        $this->fpc = new FinancePeriodClass($this->begin, $this->end);
    }

    public function handle(): object
    {
        return $this->fpc->weekClosuresPeriod();
    }
}
