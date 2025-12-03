<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
// PUBLIC ROUTES (Anyone can see)
Route::get('/dashboard', function () {
    return redirect('/jobs');
})->middleware(['auth'])->name('dashboard');
Route::get('/', function () { return view('welcome'); });

// AUTHENTICATED USERS (Admins AND Regular Users)
Route::middleware(['auth'])->group(function () {
    // Everyone can see the list
    Route::get('/jobs', [JobController::class, 'index']);
});

// ADMIN / EMPLOYER ROUTES
Route::middleware(['auth', 'can:manage-jobs'])->group(function () {
    
    // ... your existing Job routes (create, store, etc.) ...
    Route::get('/jobs/create', [JobController::class, 'create']);
    Route::post('/jobs', [JobController::class, 'store']);
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit']);
    Route::patch('/jobs/{job}', [JobController::class, 'update']);
    Route::delete('/jobs/{job}', [JobController::class, 'destroy']);

    // --- NEW: USER MANAGEMENT ---
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/admin/users/{user}/promote', [UserController::class, 'toggleAdmin']);
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy']);

});

require __DIR__.'/auth.php';


require __DIR__.'/auth.php';