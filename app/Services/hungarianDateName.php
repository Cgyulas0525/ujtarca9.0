<?php

namespace App\Services;

class hungarianDateName
{

    public static function getDayName($date) {
        $days = collect(['hétfő', 'kedd', 'szerda', 'csütörtök', 'péntek', 'szombat', 'vasárnap']);
        return $days[$date->format('N') - 1];
    }

    public static function getMonthName($date) {
        $months = collect(['január', 'február', 'március', 'április', 'május', 'június', 'július', 'augusztus', 'szeptember'. 'október', 'november', 'december']);
        return $months[$date->format('n') - 1];
    }
}
