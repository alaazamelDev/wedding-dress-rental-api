<?php

// Dress Resource
use App\Http\Controllers\DressController;
use App\Http\Controllers\ReservationController;

// Protected Routes
//Route::middleware('auth:sanctum')->group(function () {

    // Dresses
    Route::prefix('/dresses')->group(function () {
        Route::get('/', [DressController::class, 'index']);
        Route::get('/{id}', [DressController::class, 'show']);
    });

    Route::prefix('/reservation')->group(function () {
        Route::post('/reserve', [ReservationController::class, 'create']);
    });

//});

// Public Routes are placed here...
