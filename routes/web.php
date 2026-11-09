<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard'); // The view logged-in users should see
})->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::post('/agent/idea', [PageController::class, 'store'])->name('agent.idea.store');

// Edit + delete project (Admin only — enforced in controller + hidden in view)
Route::put('/projects/{project}', [DashboardController::class, 'update'])
    ->middleware('auth')
    ->name('projects.update');

Route::delete('/projects/{project}', [DashboardController::class, 'destroy'])
    ->middleware('auth')
    ->name('projects.destroy');

Route::get('/login', fn () => view('auth.login'))
    ->middleware('guest')
    ->name('login.form');

Route::get('/register', fn () => view('auth.register'))
    ->middleware('guest')
    ->name('register.form');

Route::fallback(function () {
    return view('errors.404');
});

require __DIR__.'/auth.php';
