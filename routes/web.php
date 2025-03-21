<?php

use App\Http\Controllers\AdminWebController;
use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\SuperAdminWebController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    return view('index');
});

//Auth Login web
Route::get('/login', function () {
    return view('Auth.login');
})->name('login');
Route::post('/login', [AuthWebController::class, 'login'])->name('login');
Route::get('/logout', [AuthWebController::class, 'logout'])->name('logout');

//General
Route::get('/dashboard', function () {
    return view('General.dashboard');
})->name('dashboard')->middleware('auth');

// routes/web.php
Route::get('/users', [SuperAdminWebController::class, 'index'])->name('users')->middleware('auth');


Route::get('/shippings', function () {
    return view('General.shippings');
})->name('shippings')->middleware('auth');

Route::get('/tracking', function () {
    return view('General.tracker');
})->name('tracking')->middleware('auth');
