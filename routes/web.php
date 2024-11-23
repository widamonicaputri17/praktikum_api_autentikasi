<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordResetController;

Route::get('/', function () {
    return view('welcome');
});

// Show the form to enter email for password reset
Route::get('/password/reset', function () {
    return view('auth.passwords.email');  // You can create this view for email input
})->name('password.request');

// Send the reset link email
Route::post('/password/email', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');

// Handle the actual password reset form submission
Route::post('/password/reset', [PasswordResetController::class, 'reset'])->name('password.update');
