<?php

declare(strict_types=1);

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/**
 * public routs
 */
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'logIn']);
Route::resource('announcements', AnnouncementController::class);

/**
 * token required routs
 */
Route::group(['middleware' => ['auth:sanctum']] , function () {

    Route::post('logout', [AuthController::class, 'logout']);
});
