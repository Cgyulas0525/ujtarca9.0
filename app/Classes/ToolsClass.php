<?php

namespace App\Classes;

use App\Models\Invoices;
use App\Models\Offers;
use App\Models\Partners;

use App\Enums\YesNoEnum;


class ToolsClass
{

    public static function yesNoDDDW(): array
    {
        return YesNoEnum::values();
    }

    public static function yesNo($value): string
    {
        return $value == 0 ? YesNoEnum::NO() : ($value == 1 ? YesNoEnum::YES() : "Nincs érték");
    }

    public static function aviable($partner): bool
    {
        return (empty(Invoices::where('partner_id', $partner)->first()) &&
            empty(Offers::where('partners_id', $partner)->first()) && (Partners::find($partner)->active == 0)) ? true : false;
    }

    public static function monthsPeriodDDDW(): array
    {
        return ['1 hónap', "3 hónap", "6 hónap", "12 hónap"];
    }
}
