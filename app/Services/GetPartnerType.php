<?php

namespace App\Services;

use App\Models\PartnerTypes;

class GetPartnerType
{
    public static function getPartnerTypesId($name)
    {
        return PartnerTypes::where('name', $name)->first()->id;
    }

}
