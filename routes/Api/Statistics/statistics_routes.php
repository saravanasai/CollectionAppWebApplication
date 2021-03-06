<?php

use App\Http\Controllers\Api\Statistics\StatisticsContoller;
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

    Route::get('statistics/plan',[StatisticsContoller::class,'planStatistics']);
    Route::get('statistics/agent',[StatisticsContoller::class,'agentStatistics']);
    Route::get('statistics/location',[StatisticsContoller::class,'locationStatistics']);
    Route::get('statistics/dashboard',[StatisticsContoller::class,'dashboardStatistics']);


});
