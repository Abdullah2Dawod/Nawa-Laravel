<?php

use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\CategoriesController;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/admin/products',[ProductsController::class, 'index']);
// Route::get('/admin/products/create',[ProductsController::class, 'create']);
// Route::post('/admin/products',[ProductsController::class, 'store']);
// Route::get('/admin/products/{$id}',[ProductsController::class, 'show']);
// Route::get('/admin/products/{$id}/edit',[ProductsController::class, 'edit']);
// Route::put('/admin/products/{$id}',[ProductsController::class, 'update']);
// Route::delete('/admin/products/{$id}',[ProductsController::class, 'delete']);


Route::resource('/admin/products', ProductsController::class);
Route::resource('/admin/categories', CategoriesController::class);


Route::get('/user' , [UsreController::class, 'show']);
