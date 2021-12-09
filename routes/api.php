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

/**
 * token required routs
 */
Route::group(['middleware' => ['auth:sanctum']] , function () {
    Route::resource('announcements', AnnouncementController::class);
    Route::post('logout', [AuthController::class, 'logout']);
});
