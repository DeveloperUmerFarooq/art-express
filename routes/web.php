<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserCrud;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::redirect('/home','/');
Route::view('/page','artist.portfolio.portfolio');
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




        Route::name('catergory.')->prefix('/category')->group(function(){
            Route::get('/',[CategoriesController::class,'index'])->name('index');
            Route::post('/store',[CategoriesController::class,'store'])->name('store');
            Route::get('/delete/{id}',[CategoriesController::class,'delete'])->name('delete');
            Route::post('/update',[CategoriesController::class,'update'])->name('update');

            Route::name('sub.')->prefix('/subcategory')->group(function(){
                Route::get('/{id}',[CategoriesController::class,'sub'])->name('index');
                Route::post('/store',[CategoriesController::class,'subStore'])->name('store');
                Route::get('/delete/{id}',[CategoriesController::class,'subDelete'])->name('delete');
                Route::post('/update',[CategoriesController::class,'subUpdate'])->name('update');
            });
        });

        Route::name('permission.')->prefix('/permission')->group(function(){
            Route::get('/',[PermissionController::class,'index'])->name('index');
            Route::get('/delete/{id}',[PermissionController::class,'delete'])->name('delete');
            Route::post('/store',[PermissionController::class,'store'])->name('store');
            Route::post('/update',[PermissionController::class,'update'])->name('update');
        });


    });
    Route::get('/products',[StoreController::class,'index'])->name('store');

    Route::get('product/search',[StoreController::class,'search'])->name('search');

    Route::get('/products/{id}',[StoreController::class,'products'])->name('products');
    Route::get('/products/{id}/sub',[StoreController::class,'filtered'])->name('filter');
    Route::post('/product/update',[ProductsController::class,'update'])->name('product.update');
    Route::get('/product/{id}/delete',[ProductsController::class,'delete'])->name('product.delete');

    Route::get('/product/{id}/blog',[BlogsController::class,'index'])->name('blogs');
    Route::post('/blog/add',[BlogsController::class,'store'])->name('blog.add');
    Route::post('/blog/{id}/update',[BlogsController::class,'update'])->name('blog.update');
    Route::get('/blog/{id}/delete',[BlogsController::class,'delete'])->name('blog.delete');
    Route::post('/blog/{id}/comment',[BlogsController::class,'comment'])->name('blog.comment');
    Route::get('/blog/comment/{id}/delete',[BlogsController::class,'deleteComment'])->name('blog.comment.delete');
    Route::get('/blog/{id}/like',[BlogsController::class,'like'])->name('blog.like');

    Route::get('/orders',[OrderController::class,'index'])->name('order');

    Route::get('/artist/{id}',[ProfileController::class,'portfolio'])->name('profile.view');

    Route::get('/user/{id}',[ProfileController::class,'profile'])->name('profile.details.view');

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
    Route::get('/dashboard',[ArtistController::class,'index'])->name('dashboard');

    Route::get('/categories/{id}/subcategories',[ProductsController::class,'getCategory'])->name('getcategory');

    Route::get('/products',[ProductsController::class,'index'])->name('product');
    Route::post('/product',[ProductsController::class,'store'])->name('add');
    Route::post('/product/update',[ProductsController::class,'update'])->name('product.update');
    Route::get('/product/{id}/delete',[ProductsController::class,'delete'])->name('product.delete');

    Route::post('/blog/add',[BlogsController::class,'store'])->name('blog.add');
    Route::post('/blog/{id}/update',[BlogsController::class,'update'])->name('blog.update');
    Route::get('/blog/{id}/delete',[BlogsController::class,'delete'])->name('blog.delete');

    Route::post('/blog/{id}/comment',[BlogsController::class,'comment'])->name('blog.comment');
    Route::get('/blog/comment/{id}/delete',[BlogsController::class,'deleteComment'])->name('blog.comment.delete');
    Route::get('/blog/{id}/like',[BlogsController::class,'like'])->name('blog.like');

    Route::get('/store',[StoreController::class,'index'])->name('store');

    Route::get('product/search',[StoreController::class,'search'])->name('search');

    Route::get('/products/{id}',[StoreController::class,'products'])->name('products');
    Route::get('/products/{id}/sub',[StoreController::class,'filtered'])->name('filter');
    Route::get('/product/{id}/blog',[BlogsController::class,'index'])->name('blogs');

    Route::get('/orders',[OrderController::class,'index'])->name('order');

    Route::get('/artist/{id}',[ProfileController::class,'portfolio'])->name('profile.view');



    Route::get('/auction',[AuctionController::class,'index'])->name('auction');

    Route::prefix('/profile')->group(function(){
        Route::get('/portfolio',[PortfolioController::class,'index'])->name('profile.index');
        Route::post('/portfolio/image',[PortfolioController::class,'addImage'])->name('profile.image');
        Route::get('/portfolio/image/{id}',[PortfolioController::class,'deleteImage'])->name('profile.image.delete');
        Route::get('/',[ProfileController::class,'index'])->name('profile');
        Route::post('/links',[ProfileController::class,'addSocialLinks'])->name('profile.links');
        Route::post('/links/update',[ProfileController::class,'editSocailLinks'])->name('profile.links.update');
        Route::post('/avatar',[ProfileController::class,'updateAvatar'])->name('avatar');
        Route::post('/details/update',[ProfileController::class,'updateDetails'])->name('details.update');
        Route::post('/password/update',[ProfileController::class,'updatePassword'])->name('password.update');
    });
});

Route::prefix('/user')->name('user.')->middleware(['role:user'])->group(function () {

    Route::redirect('/dashboard','/user/store')->name('dashboard');

    Route::get('/store',[StoreController::class,'index'])->name('store');
    Route::get('/products/{id}',[StoreController::class,'products'])->name('products');
    Route::get('/products/{id}/sub',[StoreController::class,'filtered'])->name('filter');

    Route::get('product/search',[StoreController::class,'search'])->name('search');

    Route::get('/product/{id}/blog',[BlogsController::class,'index'])->name('blogs');
    Route::post('/blog/{id}/comment',[BlogsController::class,'comment'])->name('blog.comment');
    Route::get('/blog/comment/{id}/delete',[BlogsController::class,'deleteComment'])->name('blog.comment.delete');
    Route::get('/blog/{id}/like',[BlogsController::class,'like'])->name('blog.like');

    Route::get('/artist/{id}',[ProfileController::class,'portfolio'])->name('profile.view');

    Route::get('/orders',[OrderController::class,'index'])->name('order');

    Route::get('/auction',[AuctionController::class,'index'])->name('auction');


    Route::get('/artists',[ArtistController::class,'artist'])->name('artist');

    Route::get('/rankings',[RankController::class,'index'])->name('ranking');


    Route::post('/order',[OrderController::class,'store'])->name('order.store');

    Route::prefix('/profile')->group(function(){
        Route::get('/',[ProfileController::class,'index'])->name('profile');
        Route::post('/links',[ProfileController::class,'addSocialLinks'])->name('profile.links');
        Route::post('/links/update',[ProfileController::class,'editSocailLinks'])->name('profile.links.update');
        Route::post('/avatar',[ProfileController::class,'updateAvatar'])->name('avatar');
        Route::post('/details/update',[ProfileController::class,'updateDetails'])->name('details.update');
        Route::post('/password/update',[ProfileController::class,'updatePassword'])->name('password.update');

    });
});
