<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\OrderReplyController;
use App\Http\Controllers\OrderdetailsController;


/*
|----------------------------------------------------------------------------------------------------------------
| Homepage / Core / Profile / Login / Logout
|----------------------------------------------------------------------------------------------------------------
*/

// Order

Route::resource('orders', OrdersController::class);
Route::get('orders.index/{orderType?}/{orderStatus?}',[OrdersController::class, 'index'])->name('ordersIndex');
Route::post('ordersStore',[OrdersController::class, 'store'])->name('ordersStore');
Route::post('ordersUpdate',[OrdersController::class, 'update'])->name('ordersUpdate');
Route::get('orders.print/{id}',[OrdersController::class, 'print'])->name('orderPrint');
Route::get('orderEmail/{id}',[OrdersController::class, 'orderEmail'])->name('orderEmail');
Route::get('orderReplay/{id}',[OrderReplyController::class, 'orderReplay'])->name('orderReplay');
Route::get('editDetails/{id}',[OrdersController::class, 'editDetails'])->name('editDetails');

Route::resource('orderdetails', OrderdetailsController::class);
Route::get('orderDetailsIndex/{id}', [OrderdetailsController::class, 'orderDetailsIndex'])->name('orderDetailsIndex');
Route::get('orderdetailsCreate/{id}', [OrderdetailsController::class, 'orderdetailsCreate'])->name('orderdetailsCreate');
Route::get('orderdetailsUpdate', [OrderdetailsController::class, 'orderdetailsUpdate'])->name('orderdetailsUpdate');
