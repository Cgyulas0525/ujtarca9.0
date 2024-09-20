<?php

namespace App\Interfaces\Reports;

use Illuminate\Support\Collection;

interface QueryTurnoverInterface
{
    public function queryTurnover(string $filter, string $fromDate, string $toDate): Collection;
}
