<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', function () {
        return view('auth.register');
    })->middleware('guest')->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::view('/', 'auth.login')->name('login');
    Route::post('/', [AuthController::class, 'login']);
},
);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->middleware('verified')->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        //! Email verification notice route
        Route::get(
            '/email/verify',
            [AuthController::class, 'verifyNotice']
        )->middleware('auth')->name('verification.notice');

        //! Email verification handler
        Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware(['signed'])->name('verification.verify');

        //! Resending Email verification notice
        Route::post('/email/verification-notication', [AuthController::class, 'verifyHandler'])->middleware(['throttle:6,1'])->name('verification.send');
        
},
);


