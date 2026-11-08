<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/beranda', [PageController::class, 'index'])->name('beranda');
Route::get('/ide-agent', [PageController::class, 'agent'])->name('agent.idea');
Route::get('/profil-mahasiswa', [PageController::class, 'mahasiswaDetail'])->name('mahasiswa.detail');

Route::post('/agent/idea', [PageController::class, 'store'])->name('agent.idea.store');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

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
