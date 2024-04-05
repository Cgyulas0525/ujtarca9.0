<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestroysController;
/*
|----------------------------------------------------------------------------------------------------------------
| Homepage / Core / Profile / Login / Logout
|----------------------------------------------------------------------------------------------------------------
*/

Route::get('destroy/{table}/{id}/{route}', [DestroysController::class, 'destroy'])->name('destroys');
Route::get('destroyWithParam/{table}/{id}/{route}/{param}', [DestroysController::class, 'destroyWithParam'])->name('destroyWithParam');
Route::get('beforeDestroys/{table}/{id}/{route}', [DestroysController::class, 'beforeDestroys'])->name('beforeDestroys');
Route::get('beforeDestroysWithParam/{table}/{id}/{route}/{param}', [DestroysController::class, 'beforeDestroysWithParam'])->name('beforeDestroysWithParam');
Route::get('beforePartnerActivation/{id}/{route}', [DestroysController::class, 'beforePartnerActivation'])->name('beforePartnerActivation');
Route::get('partnerActivation/{id}/{route}', [DestroysController::class, 'partnerActivation'])->name('partnerActivation');
Route::get('beforeProductActivation/{id}/{route}', [DestroysController::class, 'beforeProductActivation'])->name('beforeProductActivation');
Route::get('productActivation/{id}/{route}', [DestroysController::class, 'productActivation'])->name('productActivation');
