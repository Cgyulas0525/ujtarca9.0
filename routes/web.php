<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DestroysController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ClosuresController;
use App\Http\Controllers\ClosureCimletsController;
use App\Http\Controllers\RiportsController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\PartnerTrafficController;
use App\Http\Controllers\ProductsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [
    HomeController::class, 'index'
])->name('home');

Route::get('index', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('cimlets', App\Http\Controllers\CimletsController::class);

Route::get('destroy/{table}/{id}/{route}', [DestroysController::class, 'destroy'])->name('destroys');
Route::get('destroyWithParam/{table}/{id}/{route}/{param}', [DestroysController::class, 'destroyWithParam'])->name('destroyWithParam');

Route::get('beforeDestroys/{table}/{id}/{route}', [DestroysController::class, 'beforeDestroys'])->name('beforeDestroys');
Route::get('beforeDestroysWithParam/{table}/{id}/{route}/{param}', [DestroysController::class, 'beforeDestroysWithParam'])->name('beforeDestroysWithParam');

Route::get('beforePartnerActivation/{id}/{route}', [DestroysController::class, 'beforePartnerActivation'])->name('beforePartnerActivation');
Route::get('partnerActivation/{id}/{route}', [DestroysController::class, 'partnerActivation'])->name('partnerActivation');

Route::resource('paymentMethods', App\Http\Controllers\PaymentMethodsController::class);

Route::resource('partnerTypes', App\Http\Controllers\PartnerTypesController::class);

Route::resource('partners', App\Http\Controllers\PartnersController::class);

Route::resource('invoices', App\Http\Controllers\InvoicesController::class);

Route::get('invoicesIndex/{ev?}', [InvoicesController::class, 'invoicesIndex'])->name('invoicesIndex');
Route::get('invoicesIndex/{ev?}/{partner?}', [InvoicesController::class, 'invoicesIndex'])->name('invoicesIndex');

Route::get('invoicesYearsDDDW', [InvoicesController::class, 'invoicesYearsDDDW'])->name('invoicesYearsDDDW');

Route::resource('closures', App\Http\Controllers\ClosuresController::class);
Route::get('closuresIndex/{ev?}', [ClosuresController::class, 'closuresIndex'])->name('closuresIndex');

Route::resource('closureCimlets', App\Http\Controllers\ClosureCimletsController::class);
Route::get('closureCimletsIndex/{id}', [ClosureCimletsController::class, 'closureCimletsIndex'])->name('closureCimletsIndex');
Route::get('closureCimletsUpdate', [ClosureCimletsController::class, 'closureCimletsUpdate'])->name('closureCimletsUpdate');
Route::get('closureCimletsSum', [ClosureCimletsController::class, 'closureCimletsSum'])->name('closureCimletsSum');

Route::get('RevenueExpenditureIndex', [RiportsController::class, 'RevenueExpenditureIndex'])->name('RevenueExpenditureIndex');
Route::get('RevenueExpenditureMonthIndex', [RiportsController::class, 'RevenueExpenditureMonthIndex'])->name('RevenueExpenditureMonthIndex');
Route::get('TurnoverIndex', [RiportsController::class, 'TurnoverIndex'])->name('TurnoverIndex');

Route::get('postcodeSettlementDDDW',[PartnersController::class, 'postcodeSettlementDDDW'])->name('postcodeSettlementDDDW');
Route::get('partnersIndex/{active?}', [PartnersController::class, 'partnersIndex'])->name('partnersIndex');
Route::get('partnerFactSheet/{id}', [PartnersController::class, 'partnerFactSheet'])->name('partnerFactSheet');

Route::get('pTIndex',[PartnerTrafficController::class, 'pTIndex'])->name('pTIndex');
Route::get('partnerTrafficIndex/{begin}/{end}/{partner}',[PartnerTrafficController::class, 'partnerTrafficIndex'])->name('partnerTrafficIndex');

Route::resource('quantities', App\Http\Controllers\QuantitiesController::class);

Route::resource('products', App\Http\Controllers\ProductsController::class);
Route::get('products.print',[ProductsController::class, 'print'])->name('productsPrint');
Route::get('products.pdfEmail',[ProductsController::class, 'pdfEmail'])->name('pdfEmail');

Route::resource('offers', App\Http\Controllers\OffersController::class);

Route::resource('offerdetails', App\Http\Controllers\OfferdetailsController::class);
