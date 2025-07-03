<?php

use App\Http\Controllers\AdminWebController;
use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\ProfileWebController;
use App\Http\Controllers\SuperAdminWebController;
use App\Http\Controllers\UnitWebController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();

        if ($user->role && $user->role->name === 'Super Admin') {
            return redirect('/users');
        } elseif ($user->role && $user->role->name === 'Admin') {
            return redirect('/shippings');
        }
    } else {
        return redirect('/login');
    }
});

//Auth Web 
Route::get('/login', function () {
    return view('Auth.login');
})->name('login');
Route::post('/login', [AuthWebController::class, 'login'])->name('login');
Route::get('/logout', [AuthWebController::class, 'logout'])->name('logout');

//Admin Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('General.profile');
    })->name('profile');

    Route::put('/profile/update', [ProfileWebController::class, 'update'])->name('profile.update');

    Route::get('/shippings-search', [AdminWebController::class, 'searchDocument']);
    Route::get('/shippings', [AdminWebController::class, 'shippingsIndex'])->name('shippings.index');
    Route::get('/shippings/{id}', [AdminWebController::class, 'shippingsDetail'])->name('shippings.detail');
    Route::get('/add-shippings', [AdminWebController::class, 'shippingsAdd'])->name('shippings.add');
    Route::post('/shippings', [AdminWebController::class, 'shippingsAddTravelDocument'])->name('shippings.store');
    Route::delete('/shippings/{id}', [AdminWebController::class, 'shippingsDelete'])->name('shippings.destroy');

    Route::get('/shippings/{id}/edit', [AdminWebController::class, 'shippingsEdit'])->name('shippings.edit');
    Route::put('/shippings/{id}', [AdminWebController::class, 'shippingsUpdate'])->name('shippings.update');

    Route::get('/print-shippings/{id}', [AdminWebController::class, 'printShippings'])->name('shippings.print');

    Route::get('/tracking', function () {
        return view('General.tracker');
    })->name('tracking');
    
    Route::get('/search-travel-document', [AdminWebController::class, 'search']);

    Route::get('/units', [UnitWebController::class, 'index'])->name('units.index');
    Route::get('/units/create', [UnitWebController::class, 'create'])->name('units.add');
    Route::post('/units', [UnitWebController::class, 'store'])->name('units.store');
    Route::get('/units/{unit}/edit', [UnitWebController::class, 'edit'])->name('units.edit');
    Route::put('/units/{unit}', [UnitWebController::class, 'update'])->name('units.update');
    Route::delete('/units/{unit}', [UnitWebController::class, 'destroy'])->name('units.destroy');
});

Route::middleware(['auth', RoleMiddleware::class.':super admin'])->group(function () {
    Route::get('/user-search', [SuperAdminWebController::class, 'searchUser']);
    Route::get('/users', [SuperAdminWebController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [SuperAdminWebController::class, 'edit'])->name('users.edit');
    Route::get('/add-user', [SuperAdminWebController::class, 'add'])->name('users.add');
    Route::post('/users', [SuperAdminWebController::class, 'register'])->name('users.store');
    Route::put('/users/{id}', [SuperAdminWebController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [SuperAdminWebController::class, 'delete'])->name('users.destroy');
});
