<?php

namespace App\Http\Controllers;

use App\Models\Yearstacked;
use App\Models\Monthstacked;
use App\Models\Weekstacked;
use App\Services\Stacked\PeriodAverageService;
use Carbon\Carbon;
use App\Classes\OwnClass\ClosuresClass;

class DashboardController extends Controller
{

    public $periodAverageService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->periodAverageService = new PeriodAverageService();
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
            'dailySum' => ClosuresClass::getDailySum(now()->toDateString()),
            'averageDailySumMonth' => ClosuresClass::getPeriodAverageDailySum(now(), now()->subMonths(3)),
            'averageDailySum' => ClosuresClass::getPeriodAverageDailySum(now()),
        ];
        return view('dashboard.dashboard', ['params' => $array]);
    }
}
