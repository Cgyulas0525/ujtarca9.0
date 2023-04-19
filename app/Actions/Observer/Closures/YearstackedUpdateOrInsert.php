<?php

namespace App\Actions\Observer\Closures;

use App\Actions\Observer\Closures\StackedArray;
use App\Actions\Average\DatabaseAction\TableUpdateOrInsert;

class YearstackedUpdateOrInsert
{

    public static function handle($spend) {

        TableUpdateOrInsert::handle('yearstackeds',
            ['year' => $spend->count() > 0 ? $spend->first()->year : (int)date('Y')],
            StackedArray::handle($spend));

    }
}
