<?php

namespace App\Actions\Average;

use App\Classes\FinancePeriodClass;

class WeekRevenueAction
{

    private $begin;
    private $end;
    private $financePeriodClass;

    public function __construct()
    {
        $this->begin = now()->startOfWeek()->toDateString();
        $this->end = now()->toDateString();
        $this->financePeriodClass = new FinancePeriodClass($this->begin, $this->end);
    }

    public function handle(): object
    {
        return $this->financePeriodClass->weekClosuresPeriod();
    }
}
