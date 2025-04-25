<?php

use App\Http\Controllers\AdminWebController;
use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\ProfileWebController;
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

Route::middleware(['auth'])->group(function () {
    //General Route
    Route::get('/dashboard', function () {
        return view('General.dashboard');
    })->name('dashboard');

    Route::get('/dashboard', function () {
        return view('General.dashboard');
    })->name('dashboard');

    Route::get('/profile', function () {
        return view('General.profile');
    })->name('profile');

    Route::put('/profile/update', [ProfileWebController::class, 'update'])->name('profile.update');

    //Superadmin Route
    Route::get('/users', [SuperAdminWebController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [SuperAdminWebController::class, 'edit'])->name('users.edit');
    Route::get('/add-user', [SuperAdminWebController::class, 'add'])->name('users.add');

    Route::post('/users', [SuperAdminWebController::class, 'register'])->name('users.store');
    Route::put('/users/{id}', [SuperAdminWebController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [SuperAdminWebController::class, 'delete'])->name('users.destroy');

    //Admin Route
    Route::get('/shippings', [AdminWebController::class, 'shippingsIndex'])->name('shippings.index');
    Route::get('/shippings/{id}', [AdminWebController::class, 'shippingsDetail'])->name('shippings.detail');
    Route::get('/add-shippings', [AdminWebController::class, 'shippingsAdd'])->name('shippings.add');
    Route::post('/shippings', [AdminWebController::class, 'shippingsAddTravelDocument'])->name('shippings.store');
    Route::delete('/shippings/{id}', [AdminWebController::class, 'shippingsDelete'])->name('shippings.destroy');

    Route::get('/shippings/{id}/edit', [AdminWebController::class, 'shippingsEdit'])->name('shippings.edit');
    Route::put('/shippings/{id}', [AdminWebController::class, 'shippingsUpdate'])->name('shippings.update');

    //jaga-jaga
    // Route::get('/shippings/{id}', [AdminWebController::class, 'shippingsEdit'])->name('shippings.edit')->middleware('auth');
    // Route::get('/shippings/{id}', [AdminWebController::class, 'shippingsUpdate'])->name('shippings.update')->middleware('auth');

    Route::get('/print-shippings/{id}', [AdminWebController::class, 'printShippings'])->name('shippings.print');

    Route::get('/tracking', function () {
        return view('General.tracker');
    })->name('tracking');
    
    
    Route::get('/search-travel-document', [AdminWebController::class, 'search']);
});






// Route::get('/shippings', function () {
//     return view('General.shippings');
// })->name('shippings')->middleware('auth');

// Route::get('/tracking/{track_id}', [AdminWebController::class, 'showTracker'])
    // ->name('tracking')
    // ->middleware('auth');


