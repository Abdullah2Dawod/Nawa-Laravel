<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\MessagesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\AdminHomeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth' , 'auth.type:admin,super-admin'])->prefix('/admin')->group(function(){

    Route::get('/products/trashed' , [ProductsController::class, 'trashed'])->name('products.trashed');
    Route::put('/products/{product}/restore' , [ProductsController::class, 'restore'])->name('products.restore');
    Route::delete('/products/{product}/force' , [ProductsController::class, 'forceDelete'])
    ->middleware('password.confirm')
    ->name('products.force-delete');


    Route::get('/categories/trashed' , [CategoriesController::class, 'trashed'])->name('categories.trashed');
    Route::put('/categories/{category}/restore' , [CategoriesController::class, 'restore'])->name('categories.restore');
    Route::delete('/categories/{category}/force' , [CategoriesController::class, 'forceDelete'])->name('categories.force-delete');


    Route::get('/orders/trashed' , [OrdersController::class, 'trashed'])->name('orders.trashed');
    Route::put('/orders/{order}/restore' , [OrdersController::class, 'restore'])->name('orders.restore');
    Route::delete('/orders/{order}/force' , [OrdersController::class, 'forceDelete'])->name('orders.force-delete');


    Route::get('/users/trashed' , [UsersController::class, 'trashed'])->name('users.trashed');
    Route::put('/users/{user}/restore' , [UsersController::class, 'restore'])->name('users.restore');
    Route::delete('/users/{user}/force' , [UsersController::class, 'forceDelete'])->name('users.force-delete');


    Route::resource('/products', ProductsController::class);
    Route::resource('/categories', CategoriesController::class);
    Route::resource('/orders', OrdersController::class);
    Route::resource('/messages', MessagesController::class);

    Route::resource('/orders', OrdersController::class);

    // Route::get('/admin/home', [AdminHomeController::class, 'index'])->name('admin-homepage');

});

Route::middleware(['auth' , 'auth.type:super-admin'])->prefix('/admin')->group(function(){
    Route::resource('/users', UsersController::class);

});
