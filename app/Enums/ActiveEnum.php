<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\From;

enum ActiveEnum: string
{
    use InvokableCases, Options, Names, Values, From;

    case INACTIVE = 'inaktív';
    case ACTIVE = 'aktív';

    public static function labels(): array
    {
        return [
            'inaktív' => 0,
            'aktív' => 1,
        ];
    }
}
