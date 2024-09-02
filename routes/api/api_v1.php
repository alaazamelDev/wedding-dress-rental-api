<?php

// Dress Resource
use App\Http\Controllers\DressController;

Route::prefix('/dresses')->group(function () {

    // Protected Routes
//    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/', [DressController::class, 'index']);
        Route::get('/{id}', [DressController::class, 'show']);
//    });

    // Public Routes are placed here...
});
