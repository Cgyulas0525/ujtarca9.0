<?php

namespace App\Classes\Reports;

use App\Interfaces\Reports\QueryTurnoverInterface;
use Illuminate\Support\Collection;

class ReportsClass implements ReportsInterface
{
    protected object $queryTurnover;

    public function __construct(QueryTurnoverInterface $queryTurnover)
    {
        $this->queryTurnover = $queryTurnover;
    }

    public function queryTurnover(string $filter, string $fromDate, string $toDate): Collection
    {
        return $this->queryTurnover->queryTurnover($filter, $fromDate, $toDate);
    }
}
