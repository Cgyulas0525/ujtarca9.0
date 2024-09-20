<?php

namespace App\Interfaces\Reports;

interface WeekInvoicesResultInterface
{
    public function weekInvoicesResult(int $months = NULL): object;
}
