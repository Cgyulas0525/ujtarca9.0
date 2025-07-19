<?php

namespace App\Actions\Observer\Invoices;

use App\Actions\Observer\Invoices\StackedArray;
use App\Actions\Average\DatabaseAction\TableUpdateOrInsert;

class YearstackedUpdateOrInsert
{
    public static function handle($spend): void
    {
        TableUpdateOrInsert::handle(table: 'Yearstacked',
            keyArray: [
                    'year' => $spend->count() > 0 ? $spend->first()->year : (int)date('Y'),
                ],
            array: StackedArray::handle($spend));
    }
}
