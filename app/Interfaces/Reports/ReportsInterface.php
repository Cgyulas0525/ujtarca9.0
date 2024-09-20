<?php

namespace App\Interfaces\Reports;

interface ReportsInterface extends QueryTurnoverInterface, WeekInvoicesResultInterface,
                                   PaymentMethodLast30daysInterface, TurnoverLastTwoYearsInterface,
                                   MonthInvoicesResultInterface
{
}
