<?php

namespace App\Http\Controllers;

use App\Services\ForecastService;
use Auth;
use DataTables;
use Illuminate\Http\Request;

class ForecastNextYearController extends Controller
{

    public function forecastNext12MonthsIndex(Request $request, ForecastService $service)
    {
        if (!Auth::check()) {
            abort(401, 'Unauthorized');
        }

        $data = $service->forecastNext12Months();
        $revenueData = $service->getChartData('revenue');
        $spendData = $service->getChartData('spend');
        $resultData = $service->getChartData('result');

        $chartData = [
            'revenue' => $revenueData,
            'spend' => $spendData,
            'result' => $resultData,
        ];

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('riports.ForecastNext12MonthsIndex', ['data' => $data, 'chartData' => $chartData]);
    }

}
