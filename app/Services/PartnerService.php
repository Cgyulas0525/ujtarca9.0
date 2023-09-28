<?php

namespace App\Services;

use App\Models\Partners;

class PartnerService
{
    public function inactivation(): void
    {
        Partners::lastMonthsInactiveNumbers()->get()
            ->map(function ($partner) {
                $partner->active = 0;
                $partner->save();
                return $partner;
            });
    }
}
