<?php

use Illuminate\Support\Facades\Route;

/*
|----------------------------------------------------------------------------------------------------------------
| Homepage / Core / Profile / Login / Logout
|----------------------------------------------------------------------------------------------------------------
*/

Route::resource('cimlets', App\Http\Controllers\CimletsController::class);
Route::resource('paymentMethods', App\Http\Controllers\PaymentMethodsController::class);
Route::resource('partnerTypes', App\Http\Controllers\PartnerTypesController::class);
Route::resource('quantities', App\Http\Controllers\QuantitiesController::class);
Route::resource('features', App\Http\Controllers\FeatureController::class);
Route::resource('components', App\Http\Controllers\ComponentController::class);

// Pivot

Route::get('componentProductIndex/{product}', [ComponentProductController::class, 'index'])->name('componentProductIndex');
Route::get('featureProductIndex/{product}', [FeatureProductController::class, 'index'])->name('featureProductIndex');
