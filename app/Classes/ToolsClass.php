<?php

namespace App\Classes;

use App\Models\Invoices;
use App\Models\Offers;
use App\Models\Partners;

class ToolsClass
{

    public static function yesNoDDDW() {
        return ["Nem", "Igen"];
    }

    public static function yesNo($value) {
        return $value == 0 ? "Nem" : ($value == 1 ? "Igen" : "Nincs érték");
    }

    public static function aviable($partner) {
        return (empty(Invoices::where('partner_id', $partner)->first()) &&
                empty(Offers::where('partners_id', $partner)->first()) && (Partners::find($partner)->active == 0)) ? true : false;
    }

    public static function monthsPeriodDDDW() {
        return ['1 hónap', "3 hónap", "6 hónap", "12 hónap"];
    }

}
