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
    private $ysa;
    private $msa;
    private $wsa;

    public function __construct()
    {
        $this->ysa = new YearRevenueAction();
        $this->msa = new MonthRevenueAction();
        $this->wsa = new WeekRevenueAction();
    }

    public function handle(): void
    {

        DB::beginTransaction();

        try {

            YearstackedUpdateOrInsert::handle($this->ysa->handle());

            MonthstackedUpdateOrInsert::handle($this->msa->handle());

            WeekstackedUpdateOrInsert::handle($this->wsa->handle());

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();

        }

    }
}
