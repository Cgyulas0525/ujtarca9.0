<?php

namespace App\Actions\Average\DatabaseAction;

use App\Actions\Average\DatabaseAction\StackedArray;
use App\Actions\Average\DatabaseAction\TableUpdateOrInsert;
use DB;

class WeekstackedUpdateOrInsert
{

    public static function handle($revenue, $spend) {

        TableUpdateOrInsert::handle('weekstackeds',
            ['year' => (int)substr($revenue->first()->yearweek, 0, 4),
             'week' =>  (int)substr($revenue->first()->yearweek, 4, 2)],
            StackedArray::handle($revenue, $spend));

    }
}
