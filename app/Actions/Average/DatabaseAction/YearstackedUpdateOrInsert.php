<?php

namespace App\Actions\Average\DatabaseAction;

use App\Actions\Average\DatabaseAction\StackedArray;
use Carbon\Carbon;
use DB;

class YearstackedUpdateOrInsert
{

    public static function handle($revenue, $spend) {

        $array = StackedArray::handle($revenue, $spend);

        DB::table('yearstackeds')->updateOrInsert(
            ['year' => $revenue->first()->year], $array);

    }
}
