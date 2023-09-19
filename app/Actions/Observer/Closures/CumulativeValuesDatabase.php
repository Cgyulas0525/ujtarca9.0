<?php

namespace App\Actions\Observer\Closures;

use App\Actions\Average\YearRevenueAction;
use App\Actions\Average\MonthRevenueAction;
use App\Actions\Average\WeekRevenueAction;
use App\Actions\Observer\Closures\YearstackedUpdateOrInsert;
use App\Actions\Observer\Closures\MonthstackedUpdateOrInsert;
use App\Actions\Observer\Closures\WeekstackedUpdateOrInsert;

use Exeption;
use DB;

class CumulativeValuesDatabase
{
    private $yearRevenueAction;
    private $monthRevenueAction;
    private $weekRevenueAction;

    public function __construct()
    {
        $this->yearRevenueAction = new YearRevenueAction();
        $this->monthRevenueAction = new MonthRevenueAction();
        $this->weekRevenueAction = new WeekRevenueAction();
    }

    public function handle(): void
    {

        DB::beginTransaction();

        try {

            YearstackedUpdateOrInsert::handle($this->yearRevenueAction->handle());

            MonthstackedUpdateOrInsert::handle($this->monthRevenueAction->handle());

            WeekstackedUpdateOrInsert::handle($this->weekRevenueAction->handle());

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();

        }
    }
}
