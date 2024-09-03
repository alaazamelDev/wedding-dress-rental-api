<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DressController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {

    // Dresses
    Route::prefix('/dresses')->group(function () {
        Route::get('/', [DressController::class, 'index']);
        Route::get('/{id}', [DressController::class, 'show']);
    });

    // Reservations
    Route::prefix('/reservation')->group(function () {
        Route::post('/reserve', [ReservationController::class, 'createReservation']);
        Route::post('/complete', [ReservationController::class, 'completeReservation']);
    });

    Route::prefix('/users')->group(function () {
        Route::get('/my-reservations', [UserController::class, 'getUserReservations']);
        Route::post('/update-profile', [UserController::class, 'updateUserProfile']);
    });

    Route::prefix('/auth')->group(function () {
        Route::put('/change-password', [AuthController::class, 'changePassword']);
        Route::get('/user', [AuthController::class, 'getUserDetails']);
        Route::delete('/logout', [AuthController::class, 'logout']);
    });

});
// Public Routes are placed here...


Route::prefix('/auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle');   // protect login endpoint from brute force attacks
});

