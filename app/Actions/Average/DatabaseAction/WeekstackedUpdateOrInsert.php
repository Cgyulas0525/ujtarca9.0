<?php

namespace App\Actions\Average\DatabaseAction;

use App\Actions\Average\DatabaseAction\StackedArray;
use Carbon\Carbon;
use DB;

class WeekstackedUpdateOrInsert
{

    public static function handle($revenue, $spend) {

        $array = StackedArray::handle($revenue, $spend);

        DB::table('weekstackeds')->updateOrInsert(
            ['year' => (int)substr($revenue->first()->yearweek, 0, 4),
             'week' =>  (int)substr($revenue->first()->yearweek, 4, 2)],
            $array);

    }
}
