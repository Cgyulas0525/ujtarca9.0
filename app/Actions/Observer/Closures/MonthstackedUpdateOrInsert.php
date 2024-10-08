<?php

namespace App\Actions\Observer\Closures;

use App\Actions\Observer\Closures\StackedArray;
use App\Actions\Average\DatabaseAction\TableUpdateOrInsert;

class MonthstackedUpdateOrInsert
{
    public static function handle($spend): void
    {
        TableUpdateOrInsert::handle('monthstacked',
                [
                    'year' => $spend->count() > 0 ? (int)substr($spend->first()->yearmonth, 0, 4) : (int)date('Y'),
                    'month' => $spend->count() > 0 ? (int)substr($spend->first()->yearmonth, 4, 2) : (int)date('m'),
                ],
                StackedArray::handle($spend));
        }
}
