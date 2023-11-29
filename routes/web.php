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
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\OrderdetailsController;
use App\Http\Controllers\OrderReplyController;
use \App\Http\Controllers\BusinessAnalysisController;
use \App\Http\Controllers\ComponentProductController;
use \App\Http\Controllers\FeatureProductController;

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
Route::get('business-analysis', [BusinessAnalysisController::class, 'index'])->name('business-analysis');

Route::resource('cimlets', App\Http\Controllers\CimletsController::class);

Route::get('destroy/{table}/{id}/{route}', [DestroysController::class, 'destroy'])->name('destroys');
Route::get('destroyWithParam/{table}/{id}/{route}/{param}', [DestroysController::class, 'destroyWithParam'])->name('destroyWithParam');

Route::get('beforeDestroys/{table}/{id}/{route}', [DestroysController::class, 'beforeDestroys'])->name('beforeDestroys');
Route::get('beforeDestroysWithParam/{table}/{id}/{route}/{param}', [DestroysController::class, 'beforeDestroysWithParam'])->name('beforeDestroysWithParam');

Route::get('beforePartnerActivation/{id}/{route}', [DestroysController::class, 'beforePartnerActivation'])->name('beforePartnerActivation');
Route::get('partnerActivation/{id}/{route}', [DestroysController::class, 'partnerActivation'])->name('partnerActivation');
Route::get('beforeProductActivation/{id}/{route}', [DestroysController::class, 'beforeProductActivation'])->name('beforeProductActivation');
Route::get('productActivation/{id}/{route}', [DestroysController::class, 'productActivation'])->name('productActivation');

Route::resource('paymentMethods', App\Http\Controllers\PaymentMethodsController::class);

Route::resource('partnerTypes', App\Http\Controllers\PartnerTypesController::class);

Route::resource('partners', App\Http\Controllers\PartnersController::class);

Route::resource('invoices', App\Http\Controllers\InvoicesController::class);

//Route::get('invoicesIndex/{ev?}', [InvoicesController::class, 'invoicesIndex'])->name('invoicesIndex');
Route::get('invoicesIndex/{ev?}/{partner?}', [InvoicesController::class, 'invoicesIndex'])->name('invoicesIndex');

Route::get('invoicesYearsSelect', [InvoicesController::class, 'invoicesYearsSelect'])->name('invoicesYearsSelect');

Route::resource('closures', App\Http\Controllers\ClosuresController::class);
Route::get('closuresIndex/{ev?}', [ClosuresController::class, 'index'])->name('closuresIndex');

Route::resource('closureCimlets', App\Http\Controllers\ClosureCimletsController::class);
Route::get('closureCimletsIndex/{id}', [ClosureCimletsController::class, 'closureCimletsIndex'])->name('closureCimletsIndex');
Route::get('closureCimletsUpdate', [ClosureCimletsController::class, 'closureCimletsUpdate'])->name('closureCimletsUpdate');
Route::get('closureCimletsSum', [ClosureCimletsController::class, 'closureCimletsSum'])->name('closureCimletsSum');

Route::get('RevenueExpenditureIndex', [RiportsController::class, 'RevenueExpenditureIndex'])->name('RevenueExpenditureIndex');
Route::get('RevenueExpenditureMonthIndex', [RiportsController::class, 'RevenueExpenditureMonthIndex'])->name('RevenueExpenditureMonthIndex');
Route::get('TurnoverIndex', [RiportsController::class, 'TurnoverIndex'])->name('TurnoverIndex');

Route::get('postcodeSettlementDDDW',[PartnersController::class, 'postcodeSettlementDDDW'])->name('postcodeSettlementDDDW');
Route::get('settlementPostcodeByDDDW',[PartnersController::class, 'settlementPostcodeByDDDW'])->name('settlementPostcodeByDDDW');

Route::get('partnersIndex/{active?}', [PartnersController::class, 'index'])->name('partnersIndex');
Route::get('partnerFactSheet/{partner}/{year}', [PartnersController::class, 'partnerFactSheet'])->name('partnerFactSheet');
Route::get('partnerPeriodicAccounts/{partner}/{months}', [PartnersController::class, 'partnerPeriodicAccounts'])->name('partnerPeriodicAccounts');

Route::get('partnerInvoicesPeriod/{witch}', [PartnersController::class, 'partnerInvoicesPeriod'])->name('partnerInvoicesPeriod');
Route::get('partnerInvoicesPeriod/{witch}/{begin?}', [PartnersController::class, 'partnerInvoicesPeriod'])->name('partnerInvoicesPeriod');
Route::get('partnerInvoicesPeriod/{witch}/{begin?}/{end?}', [PartnersController::class, 'partnerInvoicesPeriod'])->name('partnerInvoicesPeriod');
Route::get('partnerInvoicesPeriod/{witch}/{begin?}/{end?}/{partner?}', [PartnersController::class, 'partnerInvoicesPeriod'])->name('partnerInvoicesPeriod');

Route::get('pTIndex',[PartnerTrafficController::class, 'pTIndex'])->name('pTIndex');
Route::get('partnerTrafficIndex/{begin}/{end}/{partner}',[PartnerTrafficController::class, 'partnerTrafficIndex'])->name('partnerTrafficIndex');

Route::resource('quantities', App\Http\Controllers\QuantitiesController::class);

Route::resource('products', App\Http\Controllers\ProductsController::class);
Route::get('products.print',[ProductsController::class, 'print'])->name('productsPrint');
Route::get('products.pdfEmail',[ProductsController::class, 'pdfEmail'])->name('pdfEmail');
Route::get('products.index/{active?}',[ProductsController::class, 'index'])->name('productsIndex');

Route::resource('orders', App\Http\Controllers\OrdersController::class);
Route::get('orders.index/{orderType?}/{orderStatus?}',[OrdersController::class, 'index'])->name('ordersIndex');
Route::get('orders.print/{id}',[OrdersController::class, 'print'])->name('orderPrint');
Route::get('orderEmail/{id}',[OrdersController::class, 'orderEmail'])->name('orderEmail');
Route::get('orderReplay/{id}',[OrderReplyController::class, 'orderReplay'])->name('orderReplay');

Route::resource('orderdetails', App\Http\Controllers\OrderdetailsController::class);
Route::get('orderdetailsIndex/{id}', [OrderdetailsController::class, 'orderdetailsIndex'])->name('orderdetailsIndex');
Route::get('orderdetailsCreate/{id}', [OrderdetailsController::class, 'orderdetailsCreate'])->name('orderdetailsCreate');
Route::get('orderdetailsUpdate', [OrderdetailsController::class, 'orderdetailsUpdate'])->name('orderdetailsUpdate');

Route::resource('features', App\Http\Controllers\FeatureController::class);
Route::resource('components', App\Http\Controllers\ComponentController::class);

Route::get('componentProductIndex/{product}', [ComponentProductController::class, 'index'])->name('componentProductIndex');
Route::get('featureProductIndex/{product}', [FeatureProductController::class, 'index'])->name('featureProductIndex');

Route::resource('locations', App\Http\Controllers\LocationController::class);
Route::resource('deliveries', App\Http\Controllers\DeliveryController::class);

Route::post('addLocation', [App\Http\Controllers\LocationController::class, 'addLocation'])->name('addLocation');
Route::get('getLocationByName', [App\Http\Controllers\LocationController::class, 'getLocationByName'])->name('getLocationByName');
