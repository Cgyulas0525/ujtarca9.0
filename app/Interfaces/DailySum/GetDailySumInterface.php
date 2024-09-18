<?php
namespace App\Interfaces\DailySum;

interface GetDailySumInterface {
    public function getDailySum(string $date): int;
}

