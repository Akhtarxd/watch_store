<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;


Route::controller(HomeController::class)->group(function(){
    Route::get('/','index')->name('home');
    Route::get('/view-product/{product}', 'productInfo')->name('productInfo');
    Route::get('/list-product', 'productList')->name('productList');
});

Route::resource('cart', CartController::class);
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('addToCart');
Route::get('store-order', [CartController::class, 'storeOrder'])->name('storeOrder');


Route::controller(AuthController::class)->group(function(){
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'storeUser')->name('storeUser');
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate')->name('authenticate');
    Route::post('/logout','logout')->name('logout');
});

Route::controller(UserController::class)->group(function(){
    Route::get('/profile', 'userProfile')->name('userProfile');
    Route::put('/profile', 'updateUserProfile')->name('updateUserProfile');
    Route::post('/userImageUpdate',  'userProfileImageUpdate')->name('userProfileImageUpdate');
});

Route::group(['prefix'=>'/admin', 'middleware'=>['CheckRoles']],function(){
    Route::controller(AdminController::class)->group(function(){
        Route::get('/','index')->name('adminIndex');
        Route::get('/userList','userList')->name('userList');
        Route::get('/editUser/{id}','editUser')->name('editUser');
        Route::put('/updateUser/{id}','updateUser')->name('updateUser');
        Route::post('/updateUserProfile/{id}','updateUserProfile')->name('adminUpdateUserProfile');
        Route::get('/registerUser','registerUserProfile')->name('adminRegisterUserProfile');
        Route::post('/registerUser','registerUserProfileData')->name('adminRegisterUserProfileData');
        Route::get('/changeUserStatus/{id}/{status?}','changeUserStatus')->name('adminChangeUserStatus');
    });

    Route::resource('brands', BrandsController::class);
    Route::controller(BrandsController::class)->group(function(){
      Route::get('/changeBrandStatus/{id}/{status?}', 'changeBrandStatus')->name('adminChangeBrandStatus');
      Route::post('/changeBrandImage/{id}', 'changeBrandImage')->name('adminChangeBrandImage');
    });

    Route::resource('product', ProductController::class);
    Route::controller(ProductController::class)->group(function(){
        Route::get('changeProductStatus/{id}/{status?}','changeProductStatus')->name('adminChangeProductStatus');
    });
});