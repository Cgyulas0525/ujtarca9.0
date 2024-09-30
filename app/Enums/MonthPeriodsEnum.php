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
enum MonthPeriodsEnum: string
{
    use InvokableCases, Options, Names, Values, From, Metadata;

    case ONE = '1 hónap';
    case THREE = '3 hónap';
    case SIX = '6 hónap';
    case TWELVE = '12 hónap';

}


