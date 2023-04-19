<?php

namespace App\Actions\Observer\Invoices;

use App\Actions\Observer\Invoices\StackedArray;
use App\Actions\Average\DatabaseAction\TableUpdateOrInsert;

class MonthstackedUpdateOrInsert
{
    public static function handle($spend) {

        TableUpdateOrInsert::handle('monthstackeds',
            ['year' => $spend->count() > 0 ? (int)substr($spend->first()->yearmonth, 0, 4) : (int)date('Y'),
             'month' => $spend->count() > 0 ? (int)substr($spend->first()->yearmonth, 4, 2) : (int)date('m')],
            StackedArray::handle($spend));


    }
}
