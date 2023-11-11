<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\From;
use ArchTech\Enums\Metadata;
use ArchTech\Enums\Meta\Meta;
use App\Models\PartnerTypes;
use App\Enums\MetaProperties\OrderType\{Description, Color};
#[Meta(Description::class)]
enum PartnerTypeEnum: string
{
    use InvokableCases, Options, Names, Values, From, Metadata;

    case LANDLORD = 'Bérbeadó';
    case DELIVERY = 'Szállító';
    case OWNER = 'Tulajdonos';
    case BUYER = 'Vevő';
    case OTHER = 'Egyéb';
    case MANUFACTURER = 'Gyártó';
    case DISTRIBUTOR = 'Forgalmazó';
    case BAKERY = 'Pékség';
    case WEBBUYER = 'WEB vevő';

    public static function getPartnerTypesId($name)
    {
        return PartnerTypes::where('name', $name)->first()->id;
    }
}
