<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationPartnerController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\DeliveryController;
/*
|----------------------------------------------------------------------------------------------------------------
| Homepage / Core / Profile / Login / Logout
|----------------------------------------------------------------------------------------------------------------
*/
// Location

Route::resource('locations', LocationController::class);
Route::post('addLocation', [LocationController::class, 'addLocation'])->name('addLocation');
Route::get('getLocationByName', [LocationController::class, 'getLocationByName'])->name('getLocationByName');

// LocationPartner

Route::get('locationPartnersIndex/{location}', [LocationPartnerController::class, 'index'])->name('locationPartnersIndex');
Route::get('locationPartnersCreate/{location}', [LocationPartnerController::class, 'create'])->name('locationPartnersCreate');
Route::post('locationPartnersStore', [LocationPartnerController::class, 'store'])->name('locationPartnersStore');
Route::get('locationPartnersDestroy/{location}/{partner}', [LocationPartnerController::class, 'destroy'])->name('locationPartnersDestroy');
Route::get('locationPartnersDestroyRecord/{location}/{partner}', [LocationPartnerController::class, 'destroyRecord'])->name('locationPartnersDestroyRecord');

// Delivery

Route::resource('deliveries', DeliveryController::class);
Route::post('updateModal', [DeliveryController::class, 'updateModal'])->name('updateModal');
Route::get('storeModal', [DeliveryController::class, 'storeModal'])->name('storeModal');
Route::get('deliveries.itemisedList/{id}',[DeliveryController::class, 'itemisedList'])->name('itemisedList');
Route::get('deliveries.aggregatedList/{id}',[DeliveryController::class, 'aggregatedList'])->name('aggregatedList');
