<?php

namespace App\Actions\Average\DatabaseAction;

use Carbon\Carbon;

class StackedArray
{

    public static function handle($revenue, $spend) {

        return ['revenue' => $revenue->first()->dailysum,
                'spend' => ($spend->count() > 0) ? $spend->first()->amount : 0,
                'average' => Round($revenue->first()->dailysum / $revenue->first()->days, 0),
                'card' => $revenue->first()->card,
                'szcard' => $revenue->first()->szcard,
                'cash' => $revenue->first()->dailysum - ($revenue->first()->card + $revenue->first()->szcard),
                'updated_at' => Carbon::now()
                ];

    }

}
