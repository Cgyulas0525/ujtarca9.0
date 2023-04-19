<?php

namespace App\Actions\Observer\Invoices;

use App\Actions\Observer\Invoices\StackedArray;
use App\Actions\Average\DatabaseAction\TableUpdateOrInsert;

class YearstackedUpdateOrInsert
{

    public static function handle($spend) {

        TableUpdateOrInsert::handle('yearstackeds',
            ['year' => $spend->count() > 0 ? $spend->first()->year : (int)date('Y')],
            StackedArray::handle($spend));

    }
}
