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

//Auth Web 
Route::get('/login', function () {
    return view('Auth.login');
})->name('login');
Route::post('/login', [AuthWebController::class, 'login'])->name('login');
Route::get('/logout', [AuthWebController::class, 'logout'])->name('logout');

//General Route
Route::get('/dashboard', function () {
    return view('General.dashboard');
})->name('dashboard')->middleware('auth');

//Superadmin Route
Route::get('/users', [SuperAdminWebController::class, 'index'])->name('users.index')->middleware('auth');
Route::get('/users/{id}', [SuperAdminWebController::class, 'edit'])->name('users.edit')->middleware('auth');
Route::get('/add-user', [SuperAdminWebController::class, 'add'])->name('users.add')->middleware('auth');

Route::post('/users', [SuperAdminWebController::class, 'register'])->name('users.store')->middleware('auth');
Route::put('/users/{id}', [SuperAdminWebController::class, 'update'])->name('users.update')->middleware('auth');
Route::delete('/users/{id}', [SuperAdminWebController::class, 'delete'])->name('users.destroy')->middleware('auth');

//Admin Route
Route::get('/shippings', [AdminWebController::class, 'shippingsIndex'])->name('shippings.index')->middleware('auth');
Route::get('/shippings/{id}', [AdminWebController::class, 'shippingsDetail'])->name('shippings.detail')->middleware('auth');
Route::get('/add-shippings', [AdminWebController::class, 'shippingsAdd'])->name('shippings.add')->middleware('auth');
Route::post('/shippings', [AdminWebController::class, 'shippingsAddTravelDocument'])->name('shippings.store')->middleware('auth');
Route::delete('/shippings/{id}', [AdminWebController::class, 'shippingsDelete'])->name('shippings.destroy')->middleware('auth');
// Route::get('/shippings/{id}', [AdminWebController::class, 'shippingsEdit'])->name('shippings.edit')->middleware('auth');
// Route::get('/shippings/{id}', [AdminWebController::class, 'shippingsUpdate'])->name('shippings.update')->middleware('auth');

Route::get('/print-shippings/{id}', [AdminWebController::class, 'printShippings'])->name('shippings.print')->middleware('auth');

// Route::get('/shippings', function () {
//     return view('General.shippings');
// })->name('shippings')->middleware('auth');

Route::get('/tracking', function () {
    return view('General.tracker');
})->name('tracking')->middleware('auth');
