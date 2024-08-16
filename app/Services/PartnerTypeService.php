<?php

namespace App\Services;

use App\Models\PartnerTypes;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PartnerTypeService
{
    public static function getByName(string $name): ?PartnerTypes
    {
        $partnerType = PartnerTypes::where('name', $name)->first();

        if (!$partnerType) {
            throw new ModelNotFoundException("Partner type with name {$name} not found.");
        }

        return $partnerType;
    }
}
