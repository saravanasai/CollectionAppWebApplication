<?php

use App\Http\Controllers\Api\Customer\CustomerMasterController;
use App\Http\Controllers\Api\Plan\PlanMasterController;
use Illuminate\Support\Facades\Route;

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





Route::group(['middleware'=>'auth:sanctum'],function()
{

    Route::get('customer/search-by-id/{id}',[CustomerMasterController::class,'searchByMemberId']);
    Route::apiResource('customer',CustomerMasterController::class);


});

Route::apiResource('free/customer',CustomerMasterController::class);
