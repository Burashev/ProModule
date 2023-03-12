<?php

use App\Http\Controllers\Auth\ActiveController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->withoutMiddleware(['web_authenticated'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');

    Route::post('/login', [AuthController::class, 'loginPost'])->name('loginPost');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('registerPost');
});

Route::withoutMiddleware(['activated', 'verified'])->group(function () {
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/email/verify', [EmailController::class, 'verify'])->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [EmailController::class, 'verifyHandler'])->name('verification.verify');

    Route::post('/email/verification-notification', [EmailController::class, 'sendVerificationPost'])->middleware('throttle:6,1')->name('verification.send');

    Route::get('/active', ActiveController::class)->name('active');
});
