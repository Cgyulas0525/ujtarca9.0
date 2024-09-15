<?php

namespace App\Classes\DailySum;

use App\Interfaces\DailySum\DailySumInterface;
use App\Interfaces\DailySum\GetPeriodDailySumInterface;
use App\Interfaces\DailySum\GetPeriodAverageDailySumInterface;
use Illuminate\Support\Collection;

class DailySum implements DailySumInterface
{
    protected object $getDailySum;
    protected object $getPeriodAverageDailySum;
    protected object $getPeriodDailySum;

    public function __construct(GetDailySum $getDailySum, GetPeriodAverageDailySumInterface $getPeriodAverageDailySum, GetPeriodDailySumInterface $getPeriodDailySum) {
        $this->getDailySum = $getDailySum;
        $this->getPeriodAverageDailySum = $getPeriodAverageDailySum;
        $this->getPeriodDailySum = $getPeriodDailySum;
    }


    public function getDailySum(string $date): int
    {
        return $this->getDailySum->getDailySum($date);
    }

    public function getPeriodAverageDailySum(string $day, ?string $begin = NULL, ?string $end = NULL): int
    {
        return $this->getPeriodAverageDailySum->getPeriodAverageDailySum($day, $begin, $end);
    }

    public function getPeriodDailySum(string $day, ?string $begin = NULL, ?string $end = NULL): Collection
    {
        return $this->getPeriodDailySum->getPeriodDailySum($day, $begin, $end);
    }
}
