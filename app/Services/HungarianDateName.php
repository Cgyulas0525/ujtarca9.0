<?php

namespace App\Services;

use Carbon\Carbon;

class HungarianDateName
{
    public static function getDayName(string $date): string
    {
        $days = collect(['hétfő', 'kedd', 'szerda', 'csütörtök', 'péntek', 'szombat', 'vasárnap']);
        return $days[Carbon::parse($date)->format('N') - 1];
    }

    public static function getMonthName(string $date): string
    {
        $months = collect(['január', 'február', 'március', 'április', 'május', 'június', 'július', 'augusztus', 'szeptember' . 'október', 'november', 'december']);
        return $months[Carbon::parse($date)->format('n') - 1];
    }
}
