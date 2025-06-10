<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CsChangemodelController;
use App\Http\Controllers\FilterModelController;
use App\Http\Controllers\DataModelController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/data-model', [DataModelController::class, 'index'])->name('data-model.index');
    Route::get('/filter-model', [FilterModelController::class, 'index'])->name('filter-model.index');
    Route::post('/filter-model/submit', [FilterModelController::class, 'submit'])->name('filter-model.submit');

    Route::get('/cs-change-model', [CsChangeModelController::class, 'index'])->name('cs.filter');
    Route::get('/cs-change-model/show', [CsChangeModelController::class, 'show'])->name('cs.show');

    Route::get('/edit-profile', [AuthController::class, 'editProfile'])->name('edit.profile');
    Route::post('/update-profile', [AuthController::class, 'updateProfile'])->name('update.profile');
    Route::post('/cs-submit', [CsChangeModelController::class, 'submit'])->name('cs.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});