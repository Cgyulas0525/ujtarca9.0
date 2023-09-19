<?php

namespace App\Actions\Average;

use App\Actions\Average\YearRevenueAction;
use App\Actions\Average\YearSpendAction;
use App\Actions\Average\MonthRevenueAction;
use App\Actions\Average\MonthSpendAction;
use App\Actions\Average\WeekRevenueAction;
use App\Actions\Average\WeekSpendAction;
use App\Actions\Average\DatabaseAction\YearstackedUpdateOrInsert;
use App\Actions\Average\DatabaseAction\MonthstackedUpdateOrInsert;
use App\Actions\Average\DatabaseAction\WeekstackedUpdateOrInsert;

use Exeption;
use DB;

class CumulativeValuesDatabase
{
    private $yearRevenueAction;
    private $yearSpendAction;
    private $monthRevenueAction;
    private $monthSpendAction;
    private $weekRevenueAction;
    private $weekSpendAction;

    public function __construct()
    {
        $this->yearRevenueAction = new YearRevenueAction();
        $this->yearSpendAction = new YearSpendAction();
        $this->monthRevenueAction = new MonthRevenueAction();
        $this->monthSpendAction = new MonthSpendAction();
        $this->weekRevenueAction = new WeekRevenueAction();
        $this->weekSpendAction = new WeekSpendAction();
    }

    public function handle(): void
    {

        DB::beginTransaction();

        try {

            $revenue = $this->yearRevenueAction->handle();

            if ($revenue->count() > 0) {

                $spend = $this->yearSpendAction->handle();

                YearstackedUpdateOrInsert::handle($revenue, $spend);

                $monthrevenue = $this->monthRevenueAction->handle();

                if ($monthrevenue->count() > 0) {

                    $monthspend = $this->monthSpendAction->handle();

                    MonthstackedUpdateOrInsert::handle($monthrevenue, $monthspend);

                    $weekrevenue = $this->weekRevenueAction->handle();

                    if ($weekrevenue->count() > 0) {

                        $weekspend = $this->weekSpendAction->handle();

                        WeekstackedUpdateOrInsert::handle($weekrevenue, $weekspend);

                    }
                }
            }

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();

        }
    }
}
