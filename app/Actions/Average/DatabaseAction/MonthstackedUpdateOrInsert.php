<?php

namespace App\Actions\Average\DatabaseAction;

use App\Actions\Average\DatabaseAction\StackedArray;
use App\Actions\Average\DatabaseAction\TableUpdateOrInsert;
use DB;

class MonthstackedUpdateOrInsert
{
    public static function handle($revenue, $spend): void
    {

        TableUpdateOrInsert::handle('monthstackeds',
            ['year' => (int)substr($revenue->first()->yearmonth, 0, 4),
                'month' => (int)substr($revenue->first()->yearmonth, 4, 2)],
            StackedArray::handle($revenue, $spend));

    }
}
