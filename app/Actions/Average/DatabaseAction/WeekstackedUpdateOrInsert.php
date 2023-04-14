<?php

namespace App\Actions\Average\DatabaseAction;

use Carbon\Carbon;
use DB;

class WeekstackedUpdateOrInsert
{

    public static function handle($revenue, $spend) {
        DB::table('weekstackeds')->updateOrInsert(
            ['year' => (int)substr($revenue->first()->yearweek, 0, 4),
             'week' =>  (int)substr($revenue->first()->yearweek, 4, 2)],
            ['revenue' => $revenue->first()->dailysum,
             'spend' =>$spend->first()->amount,
             'average' => Round($revenue->first()->dailysum / $revenue->first()->days, 0),
             'updated_at' => Carbon::now()
            ]);

    }
}
