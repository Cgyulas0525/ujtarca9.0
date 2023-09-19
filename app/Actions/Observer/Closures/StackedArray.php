<?php

namespace App\Actions\Observer\Closures;

use Carbon\Carbon;

class StackedArray
{
    public static function handle($spend): array
    {
        return [
            'revenue' => $spend->first()->dailysum,
            'average' => Round($spend->first()->dailysum / $spend->first()->days, 0),
            'card' => $spend->first()->card,
            'szcard' => $spend->first()->szcard,
            'cash' => $spend->first()->dailysum - ($spend->first()->card + $spend->first()->szcard),
            'updated_at' => Carbon::now()
        ];
    }
}
