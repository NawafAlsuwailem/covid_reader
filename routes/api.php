<?php

use App\Http\Controllers\WorldWideStatsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('/covid')->group(function(){

    Route::get('/countries', [CountryController::class, 'index']);
    Route::post('/countries', [CountryController::class, 'store']);
    Route::get('/countries/keyValue', [CountryController::class, 'getKeyValue']);

    Route::get('/worldwide', [WorldWideStatsController::class, 'index']);
    Route::get('/worldwide/stats', [WorldWideStatsController::class, 'getStats']);

    Route::get('/fill_data', [CountryController::class, 'getAll']);
});
