<?php

use App\Http\Controllers\AdminWebController;
use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\ProfileWebController;
use App\Http\Controllers\SuperAdminWebController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\TravelDocument;
use App\Models\User;
use Illuminate\Http\Request;

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();

        if ($user->role === 'superadmin') {
            return redirect('/profile');
        } elseif ($user->role === 'admin') {
            return redirect('/shippings');
        } else {
            return redirect('/dashboard'); 
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

//Admin Rout
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




// Route::get('/shippings', function () {
//     return view('General.shippings');
// })->name('shippings')->middleware('auth');

// Route::get('/tracking/{track_id}', [AdminWebController::class, 'showTracker'])
    // ->name('tracking')
    // ->middleware('auth');


