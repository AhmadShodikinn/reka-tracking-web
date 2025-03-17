<?php

use App\Http\Controllers\AuthWebController;
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

Route::get('/users', function () {
    return view('General.users');
})->name('users')->middleware('auth');
