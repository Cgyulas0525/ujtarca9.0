<?php

namespace App\Classes;

use App\Models\Settlements;
use http\Env\Request;

class SettlementsClass
{
    public static function settlementsDDDW(): array
    {
        return [" "] + Settlements::orderBy('name')->pluck('name', 'id')->toArray();
    }

    public static function settlementsPostcodeDDDW(): array
    {
        $settlement = Settlements::distinct()->orderBy('postcode')->get(['postcode']);
        return [" "] + $settlement->pluck('postcode', 'postcode')->toArray();
    }

    public static function postcodeSettlementDDDW($postcode): object
    {
        return Settlements::where('postcode', $postcode)->select('name', 'id')->orderBy('name')->get();
    }

    public static function settlementPostcodeByDDDW($id): object
    {
        return Settlements::where('id', $id)->select('postcode', 'id')->orderBy('postcode')->get();
    }
}
