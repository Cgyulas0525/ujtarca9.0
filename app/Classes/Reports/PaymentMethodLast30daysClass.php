<?php

namespace App\Classes\Reports;

use App\Interfaces\Reports\PaymentMethodLast30daysInterface;
use App\Models\Closures;

class PaymentMethodLast30daysClass implements PaymentMethodLast30daysInterface
{

    public function paymentMethodLast30days(): object
    {
        return Closures::selectRaw('closuredate as nap, card, szcard, (dailysum  - (card + szcard + 20000)) as dayCash')
            ->whereBetween('closuredate', [now()->subDays(30)->toDateString(), now()->toDateString()])
            ->get();
    }
}
