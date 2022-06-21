<?php

use App\Http\Controllers\Api\Location\LocationMasterController;
use App\Http\Controllers\Api\Payment\PaymentActionController;
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

    Route::post('payment/{id}',PaymentActionController::class);


});
