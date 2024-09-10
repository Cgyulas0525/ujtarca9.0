<?php

namespace App\Actions\Observer\Invoices;

use App\Actions\Observer\Invoices\StackedArray;
use App\Actions\Average\DatabaseAction\TableUpdateOrInsert;

class YearstackedUpdateOrInsert
{
    public static function handle($spend): void
    {
<<<<<<< HEAD
        TableUpdateOrInsert::handle(table: 'yearstacked',
            keyArray: [
=======
        TableUpdateOrInsert::handle('Yearstacked',
                [
>>>>>>> 1024a60851985dc1bba5feac5f3d2c261e735e52
                    'year' => $spend->count() > 0 ? $spend->first()->year : (int)date('Y'),
                ],
            array: StackedArray::handle($spend));
    }
}
