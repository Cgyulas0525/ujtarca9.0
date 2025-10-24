<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\From;
use ArchTech\Enums\Metadata;
use ArchTech\Enums\Meta\Meta;
use App\Enums\MetaProperties\OrderType\{Description, Color};

#[Meta(Description::class, Color::class)]
enum OrderTypeEnum: string
{
    use InvokableCases, Options, Names, Values, From, Metadata;

    #[Description('vevői megrendelés')] #[Color('red')]
    case CUSTOMER = 'vevői';
    #[Description('szállítói megrendelés')] #[Color('green')]
    case SUPPLIER = 'szállítói';
}
