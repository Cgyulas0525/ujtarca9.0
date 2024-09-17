<?php

namespace App\Http\Controllers;

use App\Interfaces\DailySum\DailySumInterface;
use App\Models\Yearstacked;
use App\Models\Monthstacked;
use App\Models\Weekstacked;
use App\Services\Stacked\PeriodAverageService;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public $periodAverageService;
    protected $dailySum;

    public function __construct(DailySumInterface $dailySum, PeriodAverageService $periodAverageService)
    {
        $this->middleware('auth');
        $this->periodAverageService = $periodAverageService;
        $this->dailySum = $dailySum;
    }

    public function index()
    {
        $array['weekPeriod'] = [
            '13' => $this->periodAverageService->weekPeriodResultAverage(13, Carbon::now()->weekOfMonth),
            '26' => $this->periodAverageService->weekPeriodResultAverage(26, Carbon::now()->weekOfMonth),
            '39' => $this->periodAverageService->weekPeriodResultAverage(39, Carbon::now()->weekOfMonth),
            '52' => $this->periodAverageService->weekPeriodResultAverage(52, Carbon::now()->weekOfMonth),
        ];
        $array['stacked'] = [
            'first' => Yearstacked::where('year', date('Y'))->first(),
            'before' => Yearstacked::where('year', date('Y') - 1)->first(),
            'all' => Yearstacked::get(),
            'year' => Yearstacked::all()->last(),
            'month' => Monthstacked::all()->last(),
            'week' => Weekstacked::all()->last(),
            'firstMonth' => Monthstacked::where('year', date('Y'))->where('month', date('m'))->first(),
            'firstWeek' => Weekstacked::where('year', date('Y'))->where('week', date('W'))->first(),
        ];
        $array['closure'] = [
            'dailySum' => $this->dailySum->getDailySum(now()->toDateString()),
            'averageDailySumMonth' => $this->dailySum->getPeriodAverageDailySum(now(), now()->subMonths(3)),
            'averageDailySum' => $this->dailySum->getPeriodAverageDailySum(now()),
        ];
        return view('dashboard.dashboard', ['params' => $array]);
    }
}
