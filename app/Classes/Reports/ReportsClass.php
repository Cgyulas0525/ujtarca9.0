<?php

namespace App\Classes\Reports;

use Illuminate\Support\Collection;
use App\Interfaces\Reports\ReportsInterface;
use App\Interfaces\Reports\QueryTurnoverInterface;
use App\Interfaces\Reports\WeekInvoicesResultInterface;
use App\Interfaces\Reports\PaymentMethodLast30daysInterface;
use App\Interfaces\Reports\TurnoverLastTwoYearsInterface;
use App\Interfaces\Reports\MonthInvoicesResultInterface;

class ReportsClass implements ReportsInterface
{
    protected object $queryTurnover;
    protected object $weekInvoicesResult;
    protected object $paymentMethodLast30days;
    protected object $turnoverLastTwoYears;
    protected object $monthInvoicesResult;

    public function __construct(QueryTurnoverInterface $queryTurnover,
                                WeekInvoicesResultInterface $weekInvoicesResult,
                                PaymentMethodLast30daysInterface $paymentMethodLast30days,
                                TurnoverLastTwoYearsInterface $turnoverLastTwoYears,
                                MonthInvoicesResultInterface $monthInvoicesResult
    )
    {
        $this->queryTurnover = $queryTurnover;
        $this->weekInvoicesResult = $weekInvoicesResult;
        $this->paymentMethodLast30days = $paymentMethodLast30days;
        $this->turnoverLastTwoYears = $turnoverLastTwoYears;
        $this->monthInvoicesResult = $monthInvoicesResult;
    }

    public function queryTurnover(string $filter, string $fromDate, string $toDate): Collection
    {
        return $this->queryTurnover->queryTurnover($filter, $fromDate, $toDate);
    }

    public function weekInvoicesResult(int $months = NULL): object
    {
        return $this->weekInvoicesResult->weekInvoicesResult($months);
    }

    public function paymentMethodLast30days(): object
    {
        return $this->paymentMethodLast30days->PaymentMethodLast30days();
    }

    public function turnoverLastTwoYears(): object
    {
        return $this->turnoverLastTwoYears->TurnoverLastTwoYears();
    }

    public function monthInvoicesResult(): object
    {
        return $this->monthInvoicesResult->monthInvoicesResult();
    }
}
