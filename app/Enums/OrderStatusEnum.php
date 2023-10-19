<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\From;
use ArchTech\Enums\Metadata;
use ArchTech\Enums\Meta\Meta;
use App\Enums\MetaProperties\OrderType\{Description};

#[Meta(Description::class)]
enum OrderStatusEnum: string
{
    use InvokableCases, Options, Names, Values, From, Metadata;

    case ORDERED = 'megrendelt';
    case PACKAGED = 'csomagolt';
    case DELIVERED = 'kiszállított';
}
