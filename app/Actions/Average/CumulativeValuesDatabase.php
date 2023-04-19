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
    private $yra;
    private $ysa;
    private $mra;
    private $msa;
    private $wra;
    private $wsa;

    public function __construct() {
        $this->yra = new YearRevenueAction();
        $this->ysa = new YearSpendAction();
        $this->mra = new MonthRevenueAction();
        $this->msa = new MonthSpendAction();
        $this->wra = new WeekRevenueAction();
        $this->wsa = new WeekSpendAction();
    }

    public function handle() {

        DB::beginTransaction();

        try {

            $revenue = $this->yra->handle();

            if ($revenue->count() > 0) {

                $spend = $this->ysa->handle();

                YearstackedUpdateOrInsert::handle($revenue, $spend);

                $monthrevenue = $this->mra->handle();

                if ($monthrevenue->count() > 0) {

                    $monthspend = $this->msa->handle();

                    MonthstackedUpdateOrInsert::handle($monthrevenue, $monthspend);

                    $weekrevenue = $this->wra->handle();

                    if ($weekrevenue->count() > 0) {

                        $weekspend = $this->wsa->handle();

                        WeekstackedUpdateOrInsert::handle($weekrevenue, $weekspend);

                    }
                }
            }

            DB::commit();

        } catch(\Exception $e) {

            DB::rollBack();

        }

    }
}
