<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InvoiceService;
use App\Classes\BestSupplierClass;
use App\Services\MonthstackedService;
use App\Services\YearstackedService;

class BusinessAnalysisController extends Controller
{
    public $monthStackedService, $yearStackedService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->monthStackedService = new MonthstackedService();
        $this->yearStackedService = new YearstackedService();
    }

    public function index()
    {
        $monthStackeds = $this->monthStackedService->getLastYear();
        $array['bestSuppliers'] = (new InvoiceService)->bestSupplier(new BestSupplierClass(date('Y'), 6));
        $array['monthStacked'] = [
            'last12Months' => $this->monthStackedService->getMonthsResults(12),
            'cashOfLastYear' => $monthStackeds->sum('cash'),
            'cardOfLastYear' => $monthStackeds->sum('card'),
            'szCardOfLastYear' => $monthStackeds->sum('szcard'),
        ];
        $array['yearStacked'] = [
            'cash' => $this->yearStackedService->getSumPercent('cash'),
            'card' => $this->yearStackedService->getSumPercent('card'),
            'szcard' => $this->yearStackedService->getSumPercent('szcard'),
        ];
        return view('businessanalysis.businessanalysis', ['dataArray' => $array]);
    }

}
