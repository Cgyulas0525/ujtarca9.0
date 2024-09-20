<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InvoiceService;
use App\Classes\BestSupplierClass;
use App\Services\MonthstackedService;
use App\Services\YearstackedService;
use App\Interfaces\Reports\ReportsInterface;

class BusinessAnalysisController extends Controller
{
    public $monthStackedService, $yearStackedService;
    protected object $reports;

    public function __construct(ReportsInterface $reports)
    {
        $this->middleware('auth');
        $this->monthStackedService = new MonthstackedService();
        $this->yearStackedService = new YearstackedService();
        $this->reports = $reports;
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
        $array['reports'] = [
            'turnoverLast30Days' => $this->reports->queryTurnover('closuredate as nap', now()->subDays(30)->toDateString(), now()->toDateString()),
        ];
        return view('businessanalysis.businessanalysis', ['dataArray' => $array]);
    }

}
