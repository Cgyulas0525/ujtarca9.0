<?php

namespace App\Actions\Average\DatabaseAction;

use App\Actions\Average\DatabaseAction\StackedArray;
use App\Actions\Average\DatabaseAction\TableUpdateOrInsert;

class WeekstackedUpdateOrInsert
{
    public static function handle($revenue, $spend): void
    {
        TableUpdateOrInsert::handle('weekstackeds',
                        [
                            'year' => (int)substr($revenue->first()->yearweek, 0, 4),
                            'week' => (int)substr($revenue->first()->yearweek, 4, 2),
                        ],
                        StackedArray::handle($revenue, $spend));
    }
}
