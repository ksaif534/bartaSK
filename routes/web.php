<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('register.create');
});

Route::group(['prefix' => 'auth'], function () {
    Route::get('/register/create', [AuthenticationController::class, 'create'])->name('register.create');
    Route::post('/register/store', [AuthenticationController::class, 'store'])->name('register.store');
    Route::get('/login/create', [AuthenticationController::class, 'createLogin'])->name('login.create');
    Route::post('/login/store', [AuthenticationController::class, 'storeLogin'])->name('login.store');
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('auth.logout');
});

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('profiles', ProfileController::class)->only(['edit', 'show', 'update']);
    Route::resource('posts', DashboardController::class)->except(['index']);
});
