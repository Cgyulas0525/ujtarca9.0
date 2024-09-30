<?php

namespace App\Http\Controllers;

use App\Enums\MonthPeriodsEnum;
use Illuminate\Http\Request;
use App\Traits\Reports\RevenueExpenditureIndexTrait;
use App\Traits\Reports\RevenueExpenditureMonthIndexTrait;
use App\Traits\Reports\AverageDailyTurnoverTrait;
use App\Interfaces\Reports\ReportsInterface;
use DB;

class ReportsController extends Controller
{
    protected object $reports;

    use RevenueExpenditureIndexTrait, RevenueExpenditureMonthIndexTrait, AverageDailyTurnoverTrait;

    public function __construct(ReportsInterface $reports)
    {
        $this->reports = $reports;
    }

    public function TurnoverIndex(Request $request) {

        $parameters = [
            'turnoverLast30Days' => $this->reports->queryTurnover('closuredate as nap', now()->subDays(30)->toDateString(), now()->toDateString()),
            'turnoverLast26Weeks' => $this->reports->queryTurnover('concat(CONCAT(year(closuredate),"."), if(CAST(week(closuredate, 1) AS UNSIGNED) < 10, concat("0", week(closuredate, 1)), week(closuredate, 1))) as nap',
                now()->subWeeks(26)->toDateString(),
                now()->toDateString())->groupBy('nap')->map(function ($row, $nap) {
                return [
                    'nap' => $nap,
                    'osszeg' => $row->sum('osszeg')
                ];
            })->values(),
            'turnoverLast12Month' => $this->reports->queryTurnover('concat(CONCAT(year(closuredate),"."), if(CAST(month(closuredate) AS UNSIGNED) < 10, concat("0", month(closuredate)), month(closuredate))) as nap',
                now()->subWeeks(26)->toDateString(),
                now()->toDateString())->groupBy('nap')->map(function ($row, $nap) {
                return [
                    'nap' => $nap,
                    'osszeg' => $row->sum('osszeg')
                ];
            })->values(),
            'weekInvoicesResult' => [
                '1' => $this->reports->weekInvoicesResult(1),
                '3' => $this->reports->weekInvoicesResult(3),
                '6' => $this->reports->weekInvoicesResult(6),
                '12' => $this->reports->weekInvoicesResult(12),
            ],
            'paymentMethodLast30days' => $this->reports->paymentMethodLast30days(),
            'turnoverLastTwoYears' => $this->reports->turnoverLastTwoYears(),
            'monthInvoicesResult' => $this->reports->monthInvoicesResult(),
            'monthPeriods' => MonthPeriodsEnum::options(),
        ];
        return view('riports.Turnover', ['parameters' => $parameters]);
    }
}

