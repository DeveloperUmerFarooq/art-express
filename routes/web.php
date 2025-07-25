<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomRequestController;
use App\Http\Controllers\GPTController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserCrud;
use App\Models\Comment;
use App\Models\Images;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    $images=Images::whereNotNull('product_id')->latest()->limit(30)->get();
    return view('welcome',['images'=>$images]);
})->name('welcome');
Route::view('/terms','terms')->name('terms');
Auth::routes();
Route::redirect('/home','/');
Route::get('/login', function(){
    return redirect('/');
})->name('login');
Route::get('/register',function(){
    return redirect('/');
})->name('register');
Route::middleware(['auth','suspend'])->group(function(){
// Route::view('/page','artist.portfolio.portfolio');
Route::prefix('/admin')->name('admin.')->middleware(['role:admin'])->group(function () {
    Route::get('/dashboard',[AdminController::class,'index'])->name('dashboard');
    Route::get('/dashboard/stats',[AdminController::class,'getDashboardStats'])->name('stats');

    Route::name('management.')->group(function(){
        Route::get('/users',[UserCrud::class,'user'])->name('user');
        Route::get('/artist',[UserCrud::class,'artist'])->name('artist');
        Route::get('/delete/{id}',[UserCrud::class,'delete'])->name('user.delete');
        Route::post('/add/artist',[UserCrud::class,'addArtist'])->name('artist.add');
        Route::post('/add/user',[UserCrud::class,'addUser'])->name('user.add');
        Route::post('/edit/user',[UserCrud::class,'editUsers'])->name('user.edit');

        Route::post('/user/{id}/update-status',[UserCrud::class,'updateStatus'])->name('user.status');

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
    Route::get('/artwork/{id}',[StoreController::class,'product'])->name('artwork');

    Route::get('/product/{id}/blog',[BlogsController::class,'index'])->name('blogs');
    Route::post('/blog/add',[BlogsController::class,'store'])->name('blog.add');
    Route::post('/blog/{id}/update',[BlogsController::class,'update'])->name('blog.update');
    Route::get('/blog/{id}/delete',[BlogsController::class,'delete'])->name('blog.delete');
    Route::post('/blog/{id}/comment',[BlogsController::class,'comment'])->name('blog.comment');
    Route::get('/blog/comment/{id}/delete',[BlogsController::class,'deleteComment'])->name('blog.comment.delete');
    Route::get('/blog/{id}/like',[BlogsController::class,'like'])->name('blog.like');

    Route::get('/orders',[OrderController::class,'adminOrder'])->name('order');
    Route::post('/order/{id}',[OrderController::class,'updateStatus'])->name('order.status');

    Route::get('/artist/{id}',[ProfileController::class,'portfolio'])->name('profile.view');

    Route::get('/user/{id}',[ProfileController::class,'profile'])->name('profile.details.view');

    Route::get('/auction/add',[AuctionController::class,'form'])->name('auction.form');
    Route::post('/auction/add',[AuctionController::class,'store'])->name("auction.store");
    Route::post('/auction/update',[AuctionController::class,'update'])->name("auction.update");
    Route::get('/auction/{id}',[AuctionController::class,'delete'])->name('auction.delete');

    // auction items crud
    Route::post('/item/store',[ItemsController::class,'store'])->name('item.store');
    Route::post('/item/update',[ItemsController::class,'update'])->name('item.update');
    Route::get('/item/{id}',[ItemsController::class,'delete'])->name('item.delete');

    // Bidding and aprticipation
    Route::get('/auction/{id}/start',[AuctionController::class,'start'])->name('auction.start');
    Route::get('/auction/{id}/end',[AuctionController::class,'end'])->name('auction.end');


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
    Route::get('/dashboard/stats',[ArtistController::class,'getDashboardStats'])->name('stats');

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
    Route::get('/artwork/{id}',[StoreController::class,'product'])->name('artwork');

    Route::get('/orders',[OrderController::class,'index'])->name('order');
    Route::get('/sales',[OrderController::class,'sales'])->name('sales');

    Route::get('/custom-request',[CustomRequestController::class,'index'])->name('custom.request.index');
    Route::post('/custom-request',[CustomRequestController::class,'store'])->name('custom.request.store');

    Route::get('/artist/{id}',[ProfileController::class,'portfolio'])->name('profile.view');

    Route::get('/auction/add',[AuctionController::class,'form'])->name('auction.form');
    Route::post('/auction/add',[AuctionController::class,'store'])->name("auction.store");
    Route::post('/auction/update',[AuctionController::class,'update'])->name("auction.update");
    Route::get('/auction/{id}',[AuctionController::class,'delete'])->name('auction.delete');

    // auction items crud
    Route::post('/item/store',[ItemsController::class,'store'])->name('item.store');
    Route::post('/item/update',[ItemsController::class,'update'])->name('item.update');
    Route::get('/item/{id}',[ItemsController::class,'delete'])->name('item.delete');

    // Bidding and aprticipation
    Route::get('/auction/{id}/start',[AuctionController::class,'start'])->name('auction.start');
    Route::get('/auction/{id}/end',[AuctionController::class,'end'])->name('auction.end');

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
    Route::get('/artwork/{id}',[StoreController::class,'product'])->name('artwork');
    Route::get('product/search',[StoreController::class,'search'])->name('search');

    Route::get('/product/{id}/blog',[BlogsController::class,'index'])->name('blogs');
    Route::post('/blog/{id}/comment',[BlogsController::class,'comment'])->name('blog.comment');
    Route::get('/blog/comment/{id}/delete',[BlogsController::class,'deleteComment'])->name('blog.comment.delete');
    Route::get('/blog/{id}/like',[BlogsController::class,'like'])->name('blog.like');

    Route::get('/artist/{id}',[ProfileController::class,'portfolio'])->name('profile.view');

    Route::get('/orders',[OrderController::class,'index'])->name('order');


    Route::get('/artists',[ArtistController::class,'artist'])->name('artist');


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
Route::post('/order',[OrderController::class,'store'])->name('order.store');
Route::get('/checkout/payment/{item}', [CheckoutController::class, 'show'])->name('checkout.payment');
Route::get('/order/{id}',[OrderController::class,'cancel'])->name('order.cancel');
Route::get('/comments/{id}/time', function ($id) {
    $comment = Comment::find($id);
    return response()->json(['updated_at' => $comment->updated_at->diffForHumans()]);
})->name('comment.time');
Route::get('/blogs/{id}/comments/load', [BlogsController::class, 'loadMoreComments'])->name('blog.comments.load');

Route::get('/auctions',[AuctionController::class,'index'])->name('auction');
Route::get('/auction/{id}/items',[AuctionController::class,'items'])->name("auction.items");

Route::post('/auction/register',[AuctionController::class,'register'])->name('auction.register');
Route::get('/auction/{id}/refund',[AuctionController::class,'refund'])->name('auction.refund');

Route::get('/auction/{id}/participate',[AuctionController::class,'participate'])->name('auction.participate');
Route::post('/item/{id}/place-bid',[AuctionController::class,'placeBid'])->name('bid.place');

Route::post('/checkout/process',[CheckoutController::class,'checkout'])->name('item.checkout');
Route::get('/messenger/search',[MessagesController::class, 'search'])->name('search');

Route::get('/explanation',[GPTController::class,'explain'])->name('category.explain');

 Route::get('/rankings',[RankController::class,'index'])->name('ranking');
});
