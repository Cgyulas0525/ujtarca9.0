<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Reports\RevenueExpenditureIndexTrait;
use App\Traits\Reports\RevenueExpenditureMonthIndexTrait;
use App\Traits\Reports\AverageDailyTurnoverTrait;

class ReportsController extends Controller
{
    use RevenueExpenditureIndexTrait, RevenueExpenditureMonthIndexTrait, AverageDailyTurnoverTrait;

    public function TurnoverIndex(Request $request) {

        return view('riports.Turnover');
    }
}
