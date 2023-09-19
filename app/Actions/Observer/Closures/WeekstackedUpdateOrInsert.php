<?php

namespace App\Actions\Observer\Closures;

use App\Actions\Observer\Closures\StackedArray;
use App\Actions\Average\DatabaseAction\TableUpdateOrInsert;

class WeekstackedUpdateOrInsert
{
    public static function handle($spend): void
    {
        TableUpdateOrInsert::handle('weekstackeds',
                [
                    'year' => $spend->count() > 0 ? (int)substr($spend->first()->yearweek, 0, 4) : (int)date('Y'),
                    'week' => $spend->count() > 0 ? (int)substr($spend->first()->yearweek, 4, 2) : (int)date('W'),
                ],
                StackedArray::handle($spend));
    }
}
