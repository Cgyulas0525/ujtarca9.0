<?php

namespace App\Actions\Observer\Closures;

use App\Actions\Observer\Closures\StackedArray;
use App\Actions\Average\DatabaseAction\TableUpdateOrInsert;

class YearstackedUpdateOrInsert
{
    public static function handle($spend): void
    {
        TableUpdateOrInsert::handle('Yearstacked',
                [
                    'year' => $spend->count() > 0 ? $spend->first()->year : (int)date('Y'),
                ],
                StackedArray::handle($spend));
    }
}
