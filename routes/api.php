<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api;

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
Route::post('auth/login', [Api\Auth\LoginController::class, 'login'])->name('api.auth.login');

Route::middleware('auth:api')->group(function () {
    Route::get('weather/data', [Api\Weather\DataController::class, 'data'])->name('api.weather.data');
});
