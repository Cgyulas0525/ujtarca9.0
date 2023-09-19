<?php

namespace App\Actions\Observer\Invoices;

use Carbon\Carbon;

class StackedArray
{
    public static function handle($spend): array
    {
        return [
            'spend' => ($spend->count() > 0) ? $spend->first()->amount : 0,
            'updated_at' => Carbon::now(),
        ];
    }
}
