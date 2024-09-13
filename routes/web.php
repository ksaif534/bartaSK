<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{RegisterController,LoginController};
use App\Http\Controllers\DashboardController;

Route::get('/',function(){
    return redirect()->route('register.create');
});

Route::group(['prefix' => 'auth'], function(){
    Route::resource('/register',RegisterController::class)->only(['create','store']);
    Route::resource('/login',LoginController::class)->except(['index']);
    Route::post('/logout',[LoginController::class,'logout'])->name('auth.logout');
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard.index');
});
