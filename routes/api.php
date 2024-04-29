<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Drivers\DriverController;
use App\Http\Controllers\Api\Users\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('api')->prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('verify-account', [AuthController::class, 'verfiyAccount']);
});

Route::middleware('api')->prefix('users')->group(function () {
    Route::get('my-profile', [UserController::class, 'myProfile']);
});
Route::middleware('api')->prefix('drivers')->group(function () {
    Route::get('near-drivers', [DriverController::class, 'nearestDriversToUser']);
});

