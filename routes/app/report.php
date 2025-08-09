<?php

use App\Http\Controllers\StackedReportsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportsController;
/*
|----------------------------------------------------------------------------------------------------------------
| Homepage / Core / Profile / Login / Logout
|----------------------------------------------------------------------------------------------------------------
*/

Route::get('RevenueExpenditureIndex', [ReportsController::class, 'RevenueExpenditureIndex'])->name('RevenueExpenditureIndex');
Route::get('RevenueExpenditureMonthIndex', [ReportsController::class, 'RevenueExpenditureMonthIndex'])->name('RevenueExpenditureMonthIndex');
Route::get('TurnoverIndex', [ReportsController::class, 'TurnoverIndex'])->name('TurnoverIndex');

Route::get('getMonthStackedIndex', [StackedReportsController::class, 'getMonthStackedIndex'])->name('getMonthStackedIndex');


