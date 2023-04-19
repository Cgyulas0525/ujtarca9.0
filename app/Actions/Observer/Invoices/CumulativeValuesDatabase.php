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
    private $ysa;
    private $msa;
    private $wsa;

    public function __construct() {
        $this->ysa = new YearSpendAction();
        $this->msa = new MonthSpendAction();
        $this->wsa = new WeekSpendAction();
    }

    public function handle() {

        DB::beginTransaction();

        try {

            YearstackedUpdateOrInsert::handle($this->ysa->handle());

            MonthstackedUpdateOrInsert::handle($this->msa->handle());

            WeekstackedUpdateOrInsert::handle($this->wsa->handle());

            DB::commit();

        } catch(\Exception $e) {

            DB::rollBack();

        }

    }
}
