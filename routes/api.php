<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SensorApiController;
use App\Http\Controllers\Api\NodeConfigController;
use App\Http\Controllers\Api\GatewayConfigController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    // Gateway Config Routes
    Route::get('/gateway-config', [GatewayConfigController::class, 'getConfig']);
    Route::post('/gateway-config', [GatewayConfigController::class, 'updateConfig']);

    // Node Config Routes
    Route::get('/node-config', [NodeConfigController::class, 'getConfigs']);
    Route::post('/node-config', [NodeConfigController::class, 'updateConfig']);

    // Sensor Data Routes
    Route::get('/sensor-data', [SensorApiController::class, 'getSensorData']);
    Route::post('/sensor-data', [SensorApiController::class, 'store']);
});
