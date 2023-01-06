<?php
namespace App\Classes;

use URL;
use Alert;

Class SWAlertClass {

    public static function choice($id, $title, $cancelPath, $cancelText, $confirmPath, $confirmText)
    {
        Alert::question( $title )
            ->showCancelButton('<a href="'. URL::asset($cancelPath) .'" style="color:white;">' . $cancelText .'</a>',
                'red')
            ->showConfirmButton(
                '<a href="'. URL::asset($confirmPath) .'" style="color:white;">' . $confirmText .'</a>', // here is class for link
                'gray',
            )->autoClose(false);
    }

    public static function error( $title, $text)
    {
        Alert::error( $title, $text )->autoClose(false);
    }
}

