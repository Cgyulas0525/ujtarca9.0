<?php

namespace App\Http\Controllers;

use App\Classes\Stackeds\StacksClass;
use App\Services\InvoiceService;
use App\Classes\BestSupplierClass;
use App\Interfaces\Reports\ReportsInterface;

class BusinessAnalysisController extends Controller
{
    protected object $reports;
    protected object $stacksClass;

    public function __construct(ReportsInterface $reports, StacksClass $stacksClass)
    {
        $this->middleware('auth');
        $this->reports = $reports;
        $this->stacksClass = $stacksClass;
    }

    public function index()
    {
        $monthStackeds = $this->stacksClass->getLastYear();
        $array['bestSuppliers'] = (new InvoiceService)->bestSupplier(new BestSupplierClass(date('Y'), 6));
        $array['monthStacked'] = [
            'last12Months' => $this->stacksClass->getMonthsResults(12),
            'cashOfLastYear' => $monthStackeds->sum('cash'),
            'cardOfLastYear' => $monthStackeds->sum('card'),
            'szCardOfLastYear' => $monthStackeds->sum('szcard'),
            'cash' => $this->stacksClass->getSumPercent('Monthstacked','cash'),
            'card' => $this->stacksClass->getSumPercent('Monthstacked','card'),
            'szcard' => $this->stacksClass->getSumPercent('Monthstacked','szcard'),
        ];
        $array['yearStacked'] = [
            'cash' => $this->stacksClass->getSumPercent('Yearstacked','cash'),
            'card' => $this->stacksClass->getSumPercent('Yearstacked','card'),
            'szcard' => $this->stacksClass->getSumPercent('Yearstacked','szcard'),
        ];
        $array['reports'] = [
            'turnoverLast30Days' => $this->reports->queryTurnover('closuredate as nap', now()->subDays(30)->toDateString(), now()->toDateString()),
            'daysInvoicesResult' => $this->reports->daysInvoicesResult(now()->subYear()->toDateString()),
            'daysInvoicesResult30' => $this->reports->daysInvoicesResult(now()->subDays(30)->toDateString()),
        ];
        return view('businessanalysis.businessanalysis', ['dataArray' => $array]);
    }
}
