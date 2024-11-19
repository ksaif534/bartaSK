<?php

use App\Events\UserLikesPost;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Dashboard\EditPost;
use App\Livewire\Dashboard\PostDetails;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login.create');
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
    Route::resource('posts', DashboardController::class)->except(['index', 'edit', 'update']);
    // Route::get('/posts/{post}',PostDetails::class)->name('posts.show');
    Route::get('posts/{post}/edit', EditPost::class)->name('posts.edit');
    // Route::patch('posts/{postId}/update', [EditPost::class,'update'])->name('posts.update');
    Route::get('/search', [DashboardController::class, 'search'])->name('dashboard.search');
});

// Route::get('/event',function() {
//     UserLikesPost::dispatch("Test Successful", Auth::user()->id, 1);
//     Artisan::call('queue:work',['--once' => true]);
// });

// Route::get('/listen', function (){
//     return view('listen');
// });
