<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome1');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('/admin')->name('admin.')->middleware(['role:admin'])->group(function () {
    Route::get('/dashboard',[AdminController::class,'index'])->name('dashboard');
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
