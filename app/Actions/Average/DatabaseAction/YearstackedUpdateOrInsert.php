<?php

namespace App\Actions\Average\DatabaseAction;

use Carbon\Carbon;
use DB;

class YearstackedUpdateOrInsert
{

    public static function handle($revenue, $spend) {

        DB::table('yearstackeds')->updateOrInsert(
            ['year' => $revenue->first()->year],
            ['revenue' => $revenue->first()->dailysum,
                'spend' =>$spend->first()->amount,
                'average' => Round($revenue->first()->dailysum / $revenue->first()->days, 0),
                'card' => $revenue->first()->card,
                'szcard' => $revenue->first()->szcard,
                'cash' => $revenue->first()->dailysum - ($revenue->first()->card + $revenue->first()->szcard),
                'updated_at' => Carbon::now()
            ]);

    }
}
