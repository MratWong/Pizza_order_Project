<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\user\AjaxController;
use App\Http\Controllers\user\UserController;



//login / register
Route::middleware(['admin_auth'])->group(function(){
    Route::redirect('/', 'loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});

Route::middleware(['auth'])->group(function () {
    //dashboard

    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    //admin
    Route::middleware(['admin_auth'])->group(function(){
        // category
        Route::prefix('category')->group(function(){
            Route::get('list',[CategoryController::class,'list'])->name('category#list');
            Route::get('createPage',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('create',[CategoryController::class,'create'])->name('category#create');
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
            Route::post('update',[CategoryController::class,'update'])->name('category#update');
        });
        // admin account
        Route::prefix('admin')->group(function(){
            Route::get('password/changePage',[AdminController::class,'passwordChangePage'])->name('admin#passwordChangePage');
            Route::post('password/change',[AdminController::class,'passwordChange'])->name('admin#passwordChange');
            Route::get('details',[AdminController::class,'details'])->name('admin#details');
            Route::get('editProfile',[AdminController::class,'editProfile'])->name('admin#editProfile');
            Route::get('edit/name',[AdminController::class,'editName'])->name('admin#editName');
            Route::get('edit/email',[AdminController::class,'editEmail'])->name('admin#editEmail');
            Route::get('edit/phone',[AdminController::class,'editPhone'])->name('admin#editPhone');
            Route::get('edit/address',[AdminController::class,'editAddress'])->name('admin#editAddress');
            Route::get('edit/gender',[AdminController::class,'editGender'])->name('admin#editGender');
            Route::post('updateProfile/{id}',[AdminController::class,'updateProfile'])->name('admin#updateProfile');
            Route::post('updateName/{id}',[AdminController::class,'updateName'])->name('admin#updateName');
            Route::post('updateEmail/{id}',[AdminController::class,'updateEmail'])->name('admin#updateEmail');
            Route::post('updatePhone/{id}',[AdminController::class,'updatePhone'])->name('admin#updatePhone');
            Route::post('updateGender/{id}',[AdminController::class,'updateGender'])->name('admin#updateGender');
            Route::post('updateAddress/{id}',[AdminController::class,'updateAddress'])->name('admin#updateAddress');

            // admin list
            Route::get('adminList',[AdminController::class,'adminList'])->name('admin#list');
            Route::get('edit/{id}',[AdminController::class,'adminEdit'])->name('admin#edit');
            Route::post('update/{id}',[AdminController::class,'adminUpdate'])->name('admin#update');
            Route::get('adminDelete/{id}',[AdminController::class,'adminDelete'])->name('admin#delete');
            // Route::get('changeRole/{id}',[AdminController::class,'adminChangeRole'])->name('admin#changeRole');
            Route::get('ajax/change',[AdminController::class,'ajaxChange'])->name('admin#ajaxChange');

            // user
            Route::get('userList',[UserController::class,'userList'])->name('admin#userList');
            Route::get('ajax/user/change',[UserController::class,'ajaxUserChange'])->name('admin#userChange');
            Route::get('user/delete/{id}',[UserController::class,'userDelete'])->name('admin#userDelete');
            Route::get('user/edit/{id}',[UserController::class,'userEdit'])->name('admin#userEdit');
            Route::post('user/update/{id}',[UserController::class,'userUpdate'])->name('admin#userUpdate');

        });

        // product
        Route::prefix('product')->group(function(){
            Route::get('list',[ProductController::class,'list'])->name('product#list');
            Route::get('createPage',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('create',[ProductController::class,'create'])->name('product#create');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::get('viewPage/{id}',[ProductController::class,'viewPage'])->name('product#viewPage');
            Route::get('editPage/{id}',[ProductController::class,'editPage'])->name('product#editPage');
            Route::post('update',[ProductController::class,'update'])->name('product#update');

        });

        // order
        Route::prefix('order')->group(function(){
            Route::get('orderLists',[OrderController::class,'orderList'])->name('admin#orderList');
            Route::get('changeStatus',[OrderController::class,'changeStatus'])->name('admin#changeStatus');
            Route::get('ajax/change/status',[OrderController::class,'ajaxChangeStatus'])->name('admin#ajaxChangeStatus');
            Route::get('customer/order/list/{orderCode}',[OrderController::class,'customerOrderList'])->name('admin#customerOrder');
        });

        Route::prefix('contact')->group(function(){
            Route::get('user/message',[ContactController::class,'messageList'])->name('admin#userMessage');
            Route::get('message/view/{message}',[ContactController::class,'messageView'])->name('admin#userMessageView');
            Route::post('ajax/reply/message',[ContactController::class,'messageReply'])->name('admin#ajaxReplyMessage');
        });
    });


    //User
    Route::group(['prefix' =>'user', 'middleware' => 'user_auth'],function(){
        Route::get('home',[UserController::class,'home'])->name('user#home');
        Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');
        Route::get('history',[UserController::class,'history'])->name('user#history');

        Route::prefix('pizza')->group(function(){
            Route::get('details/{id}',[UserController::class,'pizzaDetails'])->name('user#pizzadetails');
        });

        Route::prefix('cart')->group(function(){
            Route::get('cartList',[UserController::class,'cartList'])->name('user#cartList');
        });

        Route::prefix('password')->group(function(){
            Route::get('change',[UserController::class,'changePasswordPage'])->name('user#passwordchangePage');
            Route::post('change',[UserController::class,'changePassword'])->name('user#passwordChange');
        });

        Route::prefix('account')->group(function(){
            Route::get('change',[UserController::class,'accountChangePage'])->name('user#accountChangePage');
            Route::post('change/{id}',[UserController::class,'accountChange'])->name('user#accountChange');
        });

        Route::prefix('contact')->group(function(){
            Route::get('home',[ContactController::class,'contactHomePage'])->name('user#homePage');
            Route::get('chat/{message}',[ContactController::class,'contactChatPage'])->name('user#chatPage');
        });

        Route::prefix('ajax')->group(function(){
            Route::get('pizzaList',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
            Route::get('atToCart',[AjaxController::class,'atToCart'])->name('ajax#atToCart');
            Route::get('direct/cart',[AjaxController::class,'directCart'])->name('ajax#directCart');
            Route::get('direct/buy',[AjaxController::class,'directBuy'])->name('ajax#directBuy');
            Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
            Route::get('clear/cart',[AjaxController::class,'clearCart'])->name('ajax#clearCart');
            Route::get('clear/cartItem',[AjaxController::class,'clearCartItem'])->name('ajax#clearCartItem');
            Route::get('view/count',[AjaxController::class,'increaseViewCount'])->name('ajax#viewCount');
            Route::get('user/send/message',[AjaxController::class,'userSendMessage'])->name('ajax#userSendMessage');
        });
    });


});


