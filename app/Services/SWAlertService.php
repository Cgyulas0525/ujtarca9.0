<?php

namespace App\Services;

use URL;
use Alert;

class SWAlertService
{

    public static function choice(int $id, string $title, string $cancelPath, string $cancelText, string $confirmPath, string $confirmText): void
    {
        Alert::question($title)
            ->showCancelButton('<a href="' . URL::asset($cancelPath) . '" style="color:white;">' . $cancelText . '</a>',
                'red')
            ->showConfirmButton(
                '<a href="' . URL::asset($confirmPath) . '" style="color:white;">' . $confirmText . '</a>', // here is class for link
                'gray',
            )->autoClose(false);
    }

    public static function error(string $title, string $text): void
    {
        Alert::error($title, $text)->autoClose(false);
    }

}
