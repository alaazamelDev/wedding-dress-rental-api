<?php

// Dress Resource
use App\Http\Controllers\DressController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;

// Protected Routes
//Route::middleware('auth:sanctum')->group(function () {

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
});

//});

// Public Routes are placed here...
