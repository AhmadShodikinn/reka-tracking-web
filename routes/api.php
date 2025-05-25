<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DriverController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/user', [AuthController::class, 'user']);
Route::post('/forgot-password', [DriverController::class, 'forgotPassword']);

Route::post('/refresh-token', [AuthController::class, 'refreshToken']);

Route::middleware('auth:sanctum')->group(function () { 
    Route::get('/travel-documents', [DriverController::class, 'showTravelDocuments']);
    Route::get('/travel-document/{id}', [DriverController::class, 'showDetailTravelDocument']);
    Route::post('/send-location', [DriverController::class, 'sendLocation']);
    Route::post('/update-status', [DriverController::class, 'updateStatusSendSJN']);
    Route::post('/complete-tracking', [DriverController::class, 'completeDelivery']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
