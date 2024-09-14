<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use \App\Http\Controllers\BusinessAnalysisController;

/*
|----------------------------------------------------------------------------------------------------------------
| Homepage / Core / Profile / Login / Logout
|----------------------------------------------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [DashboardController::class, 'index'])->name('home');
Route::get('index', [DashboardController::class, 'index'])->name('dashboard');
Route::get('business-analysis', [BusinessAnalysisController::class, 'index'])->name('business-analysis');
