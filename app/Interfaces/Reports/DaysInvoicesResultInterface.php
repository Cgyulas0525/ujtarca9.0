<?php

namespace App\Interfaces\Reports;

interface DaysInvoicesResultInterface
{
    public function daysInvoicesResult(?string $begin = NULL, ?string $end = NULL): object;
}
