<?php

namespace App\Actions\Average\DatabaseAction;

use Carbon\Carbon;
use DB;

class MonthstackedUpdateOrInsert
{
    public static function handle($revenue, $spend) {

        DB::table('monthstackeds')->updateOrInsert(
            ['year' => (int)substr($revenue->first()->yearmonth, 0, 4),
             'month' =>  (int)substr($revenue->first()->yearmonth, 4, 2)],
            ['revenue' => $revenue->first()->dailysum,
             'spend' =>$spend->first()->amount,
             'average' => Round($revenue->first()->dailysum / $revenue->first()->days, 0),
             'updated_at' => Carbon::now()
            ]);

    }
}
