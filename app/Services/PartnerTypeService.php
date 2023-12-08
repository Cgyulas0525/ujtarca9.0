<?php

namespace App\Services;

use App\Models\PartnerTypes;
use App\Enums\PartnerTypeEnum;

class PartnerTypeService
{
    public static function getByName($name)
    {
        return PartnerTypes::where('name', $name)->first();
    }
}
