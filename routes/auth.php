<?php

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\VerifyEmailController;

Route::middleware('guest')->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Volt::route('login', 'pages.auth.login')->name('login');
    });

    // Volt::route('register', 'pages.auth.register')
    //     ->name('register');

    // Volt::route('forgot-password', 'pages.auth.forgot-password')
    //     ->name('password.request');

    // Volt::route('reset-password/{token}', 'pages.auth.reset-password')
    //     ->name('password.reset');
});

Route::middleware('auth')->group(function () {

    // Volt::route('verify-email', 'pages.auth.verify-email')
    //     ->name('verification.notice');

    // Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
    //     ->middleware(['signed', 'throttle:6,1'])
    //     ->name('verification.verify');

    // Volt::route('confirm-password', 'pages.auth.confirm-password')
    //     ->name('password.confirm');

    Route::post('logout', [AuthController::class,'logout'])
        ->name('logout');
});
