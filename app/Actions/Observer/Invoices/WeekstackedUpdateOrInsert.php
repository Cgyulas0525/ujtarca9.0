<?php

namespace App\Actions\Observer\Invoices;

use App\Actions\Observer\Invoices\StackedArray;
use App\Actions\Average\DatabaseAction\TableUpdateOrInsert;

class WeekstackedUpdateOrInsert
{
    public static function handle($spend): void
    {
        TableUpdateOrInsert::handle('Weekstacked',
            [
                'year' => $spend->count() > 0 ? (int)substr($spend->first()->yearweek, 0, 4) : (int)date('Y'),
                'week' => $spend->count() > 0 ? (int)substr($spend->first()->yearweek, 4, 2) : (int)date('W'),
            ],
            StackedArray::handle($spend));
    }
}
