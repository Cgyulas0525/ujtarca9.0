<?php

namespace App\Interfaces\DailySum;

use App\Interfaces\DailySum\GetDailySumInterface;
use App\Interfaces\DailySum\GetPeriodAverageDailySumInterface;
use App\Interfaces\DailySum\GetPeriodDailySumInterface;

interface DailySumInterface extends GetDailySumInterface, GetPeriodDailySumInterface, GetPeriodAverageDailySumInterface
{
}
