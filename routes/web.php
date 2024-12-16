<?php

use App\Http\Middleware\Role;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/assign',function(){
    auth()->user()->assignRole("user");
});

Route::prefix('/admin')->name('admin.')->group(function(){
        Route::get('/dashboard',function(){
            dd("admin dashboard");
        })->name('dashboard');
});

Route::prefix('/artist')->name('artist.')->group(function(){
    Route::get('/dashboard',function(){
        dd("artist dashboard");
    })->name('dashboard');
});

Route::prefix('/user')->name('user.')->group(function(){
    Route::get('/dashboard',function(){
        dd("user dashboard");
    })->name('dashboard');
});

Route::get('/dashboard', function () {
})->name('dashboard')->middleware('role');
