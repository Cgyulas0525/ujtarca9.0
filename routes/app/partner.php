<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\PartnerTrafficController;


/*
|----------------------------------------------------------------------------------------------------------------
| Homepage / Core / Profile / Login / Logout
|----------------------------------------------------------------------------------------------------------------
*/

// Partner

Route::resource('partners', PartnersController::class);
Route::get('postcodeSettlementDDDW',[PartnersController::class, 'postcodeSettlementDDDW'])->name('postcodeSettlementDDDW');
Route::get('settlementPostcodeByDDDW',[PartnersController::class, 'settlementPostcodeByDDDW'])->name('settlementPostcodeByDDDW');
Route::get('partnersIndex/{active?}', [PartnersController::class, 'index'])->name('partnersIndex');
Route::get('partnerFactSheet/{partner}/{year}', [PartnersController::class, 'partnerFactSheet'])->name('partnerFactSheet');
Route::get('partnerPeriodicAccounts/{partner}/{months}', [PartnersController::class, 'partnerPeriodicAccounts'])->name('partnerPeriodicAccounts');
Route::get('partnerInvoicesPeriod/{witch}', [PartnersController::class, 'partnerInvoicesPeriod'])->name('partnerInvoicesPeriod');
//Route::get('partnerInvoicesPeriod/{witch}/{begin?}', [PartnersController::class, 'partnerInvoicesPeriod'])->name('partnerInvoicesPeriod');
//Route::get('partnerInvoicesPeriod/{witch}/{begin?}/{end?}', [PartnersController::class, 'partnerInvoicesPeriod'])->name('partnerInvoicesPeriod');
//Route::get('partnerInvoicesPeriod/{witch}/{begin?}/{end?}/{partner?}', [PartnersController::class, 'partnerInvoicesPeriod'])->name('partnerInvoicesPeriod');


// PartnerTrafic

Route::get('pTIndex',[PartnerTrafficController::class, 'pTIndex'])->name('pTIndex');
Route::get('partnerTrafficIndex/{begin}/{end}/{partner}',[PartnerTrafficController::class, 'partnerTrafficIndex'])->name('partnerTrafficIndex');
