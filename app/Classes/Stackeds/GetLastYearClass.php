<?php

namespace App\Classes\Stackeds;

use App\Models\Monthstacked;

class GetLastYearClass
{
    public function getLastYear(): object
    {
        return Monthstacked::orderBy('year', 'desc')->orderBy('month', 'desc')->get()->take(12);
    }

}
