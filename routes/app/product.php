<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
/*
|----------------------------------------------------------------------------------------------------------------
| Homepage / Core / Profile / Login / Logout
|----------------------------------------------------------------------------------------------------------------
*/

Route::resource('products', ProductsController::class);
Route::get('products.print',[ProductsController::class, 'print'])->name('productsPrint');
Route::get('products.pdfEmail',[ProductsController::class, 'pdfEmail'])->name('pdfEmail');
Route::get('products.index/{active?}',[ProductsController::class, 'index'])->name('productsIndex');
