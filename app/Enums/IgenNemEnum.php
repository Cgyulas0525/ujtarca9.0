<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\From;

enum IgenNemEnum: string
{
    use InvokableCases, Options, Names, Values, From;

    case IGEN = 'Igen';
    case NEM = 'Nem';
}
