<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserCrud;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
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

        Route::get('/roles',[RolePermissionController::class,'index'])->name('role');
        Route::post('/roles/permissions/update',[RolePermissionController::class,'update'])->name('role.update');

        Route::name('permission.')->prefix('/permission')->group(function(){
            Route::get('/',[PermissionController::class,'index'])->name('index');
            Route::get('/delete/{id}',[PermissionController::class,'delete'])->name('delete');
            Route::post('/store',[PermissionController::class,'store'])->name('store');
            Route::post('/update',[PermissionController::class,'update'])->name('update');
        });


    });
    Route::get('/products',[StoreController::class,'index'])->name('store');
    Route::get('/products/{id}',[StoreController::class,'products'])->name('products');
    Route::prefix('/profile')->group(function(){
        Route::get('/',[ProfileController::class,'index'])->name('profile');
        Route::post('/links',[ProfileController::class,'addSocialLinks'])->name('profile.links');
        Route::post('/links/update',[ProfileController::class,'editSocailLinks'])->name('profile.links.update');
        Route::post('/avatar',[ProfileController::class,'updateAvatar'])->name('avatar');
        Route::post('/details/update',[ProfileController::class,'updateDetails'])->name('details.update');
        Route::post('/password/update',[ProfileController::class,'updatePassword'])->name('password.update');
    });
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
