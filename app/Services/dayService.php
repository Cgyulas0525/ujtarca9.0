<?php

namespace App\Services;

class dayService
{
    public static function hungarianDayName($date)
    {
        $day = $date->format('N');
        switch ($day) {
            case 1:
                return 'Hétfő';
                break;
            case 2:
                return 'Kedd';
                break;
            case 3:
                return 'Szerda';
                break;
            case 4:
                return 'Csütörtök';
                break;
            case 5:
                return 'Péntek';
                break;
            case 6:
                return 'Szombat';
                break;
            case 7:
                return 'Vasárnap';
                break;
            default:
                return 'Hibás dátum!';
        }
    }

}
