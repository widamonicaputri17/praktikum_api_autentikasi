<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;

// Public routes for register and login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes for siswa CRUD operations
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('siswa', SiswaController::class);  
});
