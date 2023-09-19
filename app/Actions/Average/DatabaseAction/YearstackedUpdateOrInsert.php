<?php

namespace App\Actions\Average\DatabaseAction;

use App\Actions\Average\DatabaseAction\StackedArray;
use App\Actions\Average\DatabaseAction\TableUpdateOrInsert;
use DB;

class YearstackedUpdateOrInsert
{
    public static function handle($revenue, $spend): void
    {
        TableUpdateOrInsert::handle('yearstackeds', ['year' => $revenue->first()->year], StackedArray::handle($revenue, $spend));
    }
}
