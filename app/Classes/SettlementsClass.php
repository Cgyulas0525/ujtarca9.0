<?php

namespace App\Classes;

use App\Models\Settlements;
use http\Env\Request;

class SettlementsClass
{
    public static function settlementsDDDW()
    {
        return [" "] + Settlements::orderBy('name')->pluck('name', 'id')->toArray();
    }

    public static function settlementsPostcodeDDDW()
    {
        $settlement = Settlements::distinct()->orderBy('postcode')->get(['postcode']);
        return [" "] + $settlement->pluck('postcode', 'postcode')->toArray();
    }

    public static function postcodeSettlementDDDW($postcode)
    {
        return Settlements::where('postcode', $postcode)->select('name', 'id')->orderBy('name')->get();
    }
}
