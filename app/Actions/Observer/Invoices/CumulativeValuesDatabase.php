<?php

namespace App\Actions\Observer\Invoices;

use App\Actions\Average\YearSpendAction;
use App\Actions\Average\MonthSpendAction;
use App\Actions\Average\WeekSpendAction;
use App\Actions\Observer\Invoices\YearstackedUpdateOrInsert;
use App\Actions\Observer\Invoices\MonthstackedUpdateOrInsert;
use App\Actions\Observer\Invoices\WeekstackedUpdateOrInsert;

use Exeption;
use DB;

class CumulativeValuesDatabase
{
    private $yearSpendAction;
    private $monthSpendAction;
    private $weekSpendAction;

    public function __construct()
    {
        $this->yearSpendAction = new YearSpendAction();
        $this->monthSpendAction = new MonthSpendAction();
        $this->weekSpendAction = new WeekSpendAction();
    }

    public function handle(): void
    {

        DB::beginTransaction();

        try {

            YearstackedUpdateOrInsert::handle($this->yearSpendAction->handle());

            MonthstackedUpdateOrInsert::handle($this->monthSpendAction->handle());

            WeekstackedUpdateOrInsert::handle($this->weekSpendAction->handle());

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();

        }
    }
}
