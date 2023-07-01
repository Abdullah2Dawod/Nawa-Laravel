<?php

use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsreController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class , 'index'])->name('home');
Route::get('/products/{product}', [App\Http\Controllers\ProductsController::class , 'show'])->name('shop.products.show');

// Route::get('/admin/products',[ProductsController::class, 'index']);
// Route::get('/admin/products/create',[ProductsController::class, 'create']);
// Route::post('/admin/products',[ProductsController::class, 'store']);
// Route::get('/admin/products/{$id}',[ProductsController::class, 'show']);
// Route::get('/admin/products/{$id}/edit',[ProductsController::class, 'edit']);
// Route::put('/admin/products/{$id}',[ProductsController::class, 'update']);
// Route::delete('/admin/products/{$id}',[ProductsController::class, 'delete']);

Route::get('/admin/products/trashed' , [ProductsController::class, 'trashed'])->name('products.trashed');
Route::put('/admin/products/{product}/restore' , [ProductsController::class, 'restore'])->name('products.restore');
Route::delete('/admin/products/{product}/force' , [ProductsController::class, 'forceDelete'])->name('products.force-delete');


Route::get('/admin/categories/trashed' , [CategoriesController::class, 'trashed'])->name('categories.trashed');
Route::put('/admin/categories/{category}/restore' , [CategoriesController::class, 'restore'])->name('categories.restore');
Route::delete('/admin/categories/{category}/force' , [CategoriesController::class, 'forceDelete'])->name('categories.force-delete');


Route::resource('/admin/products', ProductsController::class);
Route::resource('/admin/categories', CategoriesController::class);
