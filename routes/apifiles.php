<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyApiController;

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

Route::get('api/partnerActiveFlag', [MyApiController::class, 'partnerActiveFlag']);
Route::get('api/getProduct', [MyApiController::class, 'getProduct']);
Route::get('api/getQuantity', [MyApiController::class, 'getQuantity']);

