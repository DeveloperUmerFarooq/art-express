<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserCrud;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome1');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('/admin')->name('admin.')->middleware(['role:admin'])->group(function () {
    Route::get('/dashboard',[AdminController::class,'index'])->name('dashboard');
    Route::name('management.')->group(function(){
        Route::get('/users',[UserCrud::class,'user'])->name('user');
        Route::get('/artist',[UserCrud::class,'artist'])->name('artist');
        Route::get('/delete/{id}',[UserCrud::class,'delete'])->name('user.delete');
        Route::post('/add/artist',[UserCrud::class,'addArtist'])->name('artist.add');
        Route::post('/add/user',[UserCrud::class,'addUser'])->name('user.add');
        Route::post('/edit/user',[UserCrud::class,'editUsers'])->name('user.edit');
    });
    Route::get('/profile',[ProfileController::class,'index'])->name('profile');
    Route::post('/profile/avatar',[ProfileController::class,'updateAvatar'])->name('avatar');
});

Route::prefix('/artist')->name('artist.')->middleware(['role:artist'])->group(function () {
    Route::get('/dashboard', function () {
        dd("artist dashboard");
    })->name('dashboard');
});

Route::prefix('/user')->name('user.')->middleware(['role:user'])->group(function () {
    Route::get('/dashboard', function () {
        dd("user dashboard");
    })->name('dashboard');
});
