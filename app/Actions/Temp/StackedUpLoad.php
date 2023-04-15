<?php

use App\Classes\FinancePeriodClass;

use App\Actions\Average\DatabaseAction\YearstackedUpdateOrInsert;
use App\Actions\Average\DatabaseAction\MonthstackedUpdateOrInsert;
use App\Actions\Average\DatabaseAction\WeekstackedUpdateOrInsert;


$begin = \App\Models\Closures::first()->closuredate;
$end = date('Y-m-d', strtotime('today'));

$fpc = new FinancePeriodClass($begin, $end);

$weeks = $fpc->weekClosuresPeriod();
$months = $fpc->mounthClosuresPeriod();
$years = $fpc->yearClosuresPeriod();

$weekspend = $fpc->weekInviocesPeriod($begin, $end);
$monthspend = $fpc->mountInviocesPeriod($begin, $end);
$yearspend = $fpc->yearInviocesPeriod($begin, $end);

foreach ($weeks as $year) {
    $yearfind = $weeks->where('yearweek', $year->yearweek);
    $find = $weekspend->where('yearweek', $year->yearweek);
    WeekstackedUpdateOrInsert::handle($yearfind, $find);
}

foreach ($months as $year) {
    $yearfind = $months->where('yearmonth', $year->yearmonth);
    $find = $monthspend->where('yearmonth', $year->yearmonth);
    MonthstackedUpdateOrInsert::handle($yearfind, $find);
}

foreach ($years as $year) {
    $yearfind = $years->where('year', $year->year);
    $find = $yearspend->where('year', $year->year);
    YearstackedUpdateOrInsert::handle($yearfind, $find);
}
