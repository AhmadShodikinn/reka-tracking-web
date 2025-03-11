<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DriverController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/user', [AuthController::class, 'user']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
});

Route::get('/travel-document/{id}', [DriverController::class, 'showDataTravelDocument'])->middleware('auth:sanctum');
Route::post('/send-location', [DriverController::class, 'sendLocation'])->middleware('auth:sanctum');
Route::post('/update-status', [DriverController::class, 'updateStatusSendSJN'])->middleware('auth:sanctum');
