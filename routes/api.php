<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthController;
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
Route::post('register', [AuthController::class, 'register']);
Route::group(['middleware' => ['auth:sanctum']] , function () {
    Route::resource('announcements', AnnouncementController::class);
    Route::post('logout', [AuthController::class, 'logout']);
});