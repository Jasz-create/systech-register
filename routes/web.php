<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\BadRegistrationController;

Route::get('/', fn() => redirect()->route('register.form'));

/** Flujo correcto (Patrones) */
Route::get('/register', [RegistrationController::class, 'create'])->name('register.form');
Route::post('/register', [RegistrationController::class, 'store'])->name('register.store');

/** DEMO Anti-Patrones (para evidencias) */
Route::get('/bad/register', [BadRegistrationController::class, 'create'])->name('bad.form');
Route::post('/bad/register', [BadRegistrationController::class, 'store'])->name('bad.store');
