<?php

namespace App\Classes\Reports;

use App\Models\Closures;
use Illuminate\Support\Collection;
use App\Interfaces\Reports\QueryTurnoverInterface;

class QueryTurnoverClass implements QueryTurnoverInterface
{
    public function queryTurnover(string $filter, string $fromDate, string $toDate): Collection
    {
        return Closures::selectRaw($filter . ', (dailysum - 20000) as osszeg')
            ->whereBetween('closuredate', [$fromDate, $toDate])
            ->get();
    }
}
