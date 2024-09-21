<?php

namespace App\Classes\Stackeds;

class StacksClass
{
    protected object $sumPercent;
    protected object $getLastYear;
    protected object $getMonthResult;
    protected object $getWeekPeriodResultAverage;

    public function __construct(StackSumPercentClass $sumPercent,
                                GetLastYearClass $getLastYear,
                                GetMonthResultClass $getMonthResult,
                                GetWeekPeriodResultAverageClass $getWeekPeriodResultAverage)
    {
        $this->sumPercent = $sumPercent;
        $this->getLastYear = $getLastYear;
        $this->getMonthResult = $getMonthResult;
        $this->getWeekPeriodResultAverage = $getWeekPeriodResultAverage;
    }

    public function getSumPercent(string $model, string $field): int
    {
        return $this->sumPercent->getSumPercent($model, $field);
    }

    public function getLastYear()
    {
        return $this->getLastYear->getLastYear();
    }

    public function getMonthsResults(int $months): object
    {
        return $this->getMonthResult->getMonthsResults($months);
    }

    public function weekPeriodResultAverage(int $howmany, int $withweek): array
    {
        return $this->getWeekPeriodResultAverage->weekPeriodResultAverage($howmany, $withweek);
    }

}
