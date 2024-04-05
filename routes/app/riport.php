<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RiportsController;
/*
|----------------------------------------------------------------------------------------------------------------
| Homepage / Core / Profile / Login / Logout
|----------------------------------------------------------------------------------------------------------------
*/

Route::get('RevenueExpenditureIndex', [RiportsController::class, 'RevenueExpenditureIndex'])->name('RevenueExpenditureIndex');
Route::get('RevenueExpenditureMonthIndex', [RiportsController::class, 'RevenueExpenditureMonthIndex'])->name('RevenueExpenditureMonthIndex');
Route::get('TurnoverIndex', [RiportsController::class, 'TurnoverIndex'])->name('TurnoverIndex');
