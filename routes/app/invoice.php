<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoicesController;
/*
|----------------------------------------------------------------------------------------------------------------
| Homepage / Core / Profile / Login / Logout
|----------------------------------------------------------------------------------------------------------------
*/

Route::resource('invoices', InvoicesController::class);
Route::get('beforeInvoiceReferred/{id}/{route}', [InvoicesController::class, 'beforeInvoiceReferred'])->name('beforeInvoiceReferred');
Route::get('changeReferredDate/{id}/{route}', [InvoicesController::class, 'changeReferredDate'])->name('changeReferredDate');
Route::get('invoicesIndex/{year?}/{partner?}', [InvoicesController::class, 'invoicesIndex'])->name('invoicesIndex');
Route::get('notReferredInvoicesIndex/{year?}/{partner?}', [InvoicesController::class, 'notReferredInvoicesIndex'])->name('notReferredInvoicesIndex');
Route::get('referredIndex', [InvoicesController::class, 'referredIndex'])->name('referredIndex');
Route::get('invoicesYearsSelect', [InvoicesController::class, 'invoicesYearsSelect'])->name('invoicesYearsSelect');
