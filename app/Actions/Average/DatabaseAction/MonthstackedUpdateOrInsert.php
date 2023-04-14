<?php

namespace App\Actions\Average\DatabaseAction;

use App\Actions\Average\DatabaseAction\StackedArray;
use Carbon\Carbon;
use DB;

class MonthstackedUpdateOrInsert
{
    public static function handle($revenue, $spend) {

        $array = StackedArray::handle($revenue, $spend);

        DB::table('monthstackeds')->updateOrInsert(
            ['year' => (int)substr($revenue->first()->yearmonth, 0, 4),
             'month' =>  (int)substr($revenue->first()->yearmonth, 4, 2)],
            $array);

    }
}
