<?php

namespace App\Services;

use App\Enums\ActiveEnum;
use App\Models\Partners;

class PartnerService
{
    public function inactivation(): void
    {
        Partners::lastMonthsInactiveNumbers(12)->get()
            ->map(function ($partner) {
                $partner->active = ActiveEnum::INACTIVE->value;
                $partner->save();
                return $partner;
            });
    }
}
