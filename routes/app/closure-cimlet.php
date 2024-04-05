<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClosuresController;
use App\Http\Controllers\ClosureCimletsController;


/*
|----------------------------------------------------------------------------------------------------------------
| Homepage / Core / Profile / Login / Logout
|----------------------------------------------------------------------------------------------------------------
*/

// Closure

Route::resource('closures', ClosuresController::class);
Route::get('closuresIndex/{ev?}', [ClosuresController::class, 'index'])->name('closuresIndex');

// ClosureCimlets

Route::resource('closureCimlets', ClosureCimletsController::class);
Route::get('closureCimletsIndex/{id}', [ClosureCimletsController::class, 'closureCimletsIndex'])->name('closureCimletsIndex');
Route::get('closureCimletsUpdate', [ClosureCimletsController::class, 'closureCimletsUpdate'])->name('closureCimletsUpdate');
Route::get('closureCimletsSum', [ClosureCimletsController::class, 'closureCimletsSum'])->name('closureCimletsSum');
