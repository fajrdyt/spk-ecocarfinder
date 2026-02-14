<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\SPKController;

// ==================== AUTHENTICATION ROUTES ====================

// Login
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Email Verification
Route::get('/verify-email', [AuthController::class, 'showVerification'])->name('verification.notice');
Route::post('/verify-email', [AuthController::class, 'verifyEmail'])->name('verification.verify');
Route::post('/resend-verification', [AuthController::class, 'resendVerificationCode'])->name('verification.resend');

// Forgot Password
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

// Reset Password
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// ==================== PROTECTED ROUTES ====================

Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // CRUD Kriteria
    Route::resource('kriteria', KriteriaController::class);
    
    // CRUD Kendaraan
    Route::resource('kendaraan', KendaraanController::class);
    
    // Hasil Perangkingan SPK
    Route::get('/spk', [SPKController::class, 'index'])->name('spk.index');
});