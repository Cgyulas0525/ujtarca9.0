<?php

namespace App\Services;

use App\Models\Yearstacked;

class YearstackedService
{
    public function getSumPercent($field) {
        return Round(Yearstacked::all()->sum($field) / (Yearstacked::all()->sum('revenue') / 100), 0);
    }
}
