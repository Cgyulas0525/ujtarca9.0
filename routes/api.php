<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\truncateTablesController;
use App\Http\Controllers\Api\outputFilesDeleteController;
use App\Http\Controllers\Api\PartnerInactivationController;
use App\Http\Controllers\ComponentProductController;
use App\Http\Controllers\FeatureProductController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\Api\ModalPartnerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('truncateAllTables', [truncateTablesController::class, 'truncateAllTables']);
Route::get('deleteOutputFiles', [outputFilesDeleteController::class, 'deleteOutputFiles']);
Route::get('partnerInactivation', [PartnerInactivationController::class, 'partnerInactivation']);
Route::post('componentProductUpdate', [ComponentProductController::class, 'componentProductUpdate']);
Route::post('featureProductUpdate', [FeatureProductController::class, 'featureProductUpdate']);
Route::post('getDeliveryByDateAndLocation', [DeliveryController::class, 'getDeliveryByDateAndLocation']);

Route::post('newPartnerByModal', [ModalPartnerController::class, 'newPartnerByModal']);
Route::post('getPartnerByEmail', [ModalPartnerController::class, 'getPartnerByEmail']);
Route::post('getPartnerByName', [ModalPartnerController::class, 'getPartnerByName']);






