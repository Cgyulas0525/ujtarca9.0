<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('sumInvoice', [DashboardController::class, 'sumInvoice'])->name('sumInvoice');
Route::get('sumClosure', [DashboardController::class, 'sumClosure'])->name('sumClosure');
Route::get('sumFinancialResult', [DashboardController::class, 'sumFinancialResult'])->name('sumFinancialResult');
Route::get('sumCash', [DashboardController::class, 'sumCash'])->name('sumCash');
Route::get('sumCard', [DashboardController::class, 'sumCard'])->name('sumCard');
Route::get('sumSZCard', [DashboardController::class, 'sumSZCard'])->name('sumSZCard');
Route::get('sumAverige', [DashboardController::class, 'sumAverige'])->name('sumAverige');
