<?php

use App\Http\Controllers\AthleteController;
use App\Http\Controllers\FileController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('athletes')->group(function () {
    Route::get('/', [AthleteController::class, 'index']);
    Route::get('/{athlete}', [AthleteController::class, 'show']);
    Route::delete('/{athlete}', [AthleteController::class, 'destroy']);
});

Route::post('/files', [FileController::class, 'store']);
