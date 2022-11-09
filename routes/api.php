<?php

use App\Http\Controllers\Api\V1\MyController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1/notebooks', 'namespace' => 'V1'], function() {
    Route::get('', [MyController::class, 'index']);
    Route::get('/{notebook}', [MyController::class, 'show']);
    Route::post('', [MyController::class, 'store']);
    Route::post('{id}', [MyController::class, 'update']);
    Route::delete('{id}', [MyController::class, 'delete']);
});
