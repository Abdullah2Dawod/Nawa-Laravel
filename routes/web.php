<?php

use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductMobileController;
use App\Http\Controllers\ProductsController as ControllersProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\showLaptopController;
use App\Http\Controllers\showMobileController;
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

Route::get('/', [HomeController::class, 'index' ])->name('home');
// Route::get('/', [HomeController::class, 'showMobiles' ])->name('show_mobile');

Route::get('/about_us', [HomeController::class, 'about'])->name('about_us');
// Route::get('/contact_us', [HomeController::class, 'index_contact'])->name('contact_us');
Route::get('/contact_us', [HomeController::class, 'create'])->name('contact_us');
Route::post('/contact_us', [HomeController::class, 'store'])->name('store_contact_us');


Route::get('/home', [AdminHomeController::class, 'index'])
    ->middleware(['auth', 'auth.type:admin,super-admin'])->prefix('/admin')->name('admin.homepage');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/review', [ReviewController::class, 'index']);
Route::post('/review/{id}', [ReviewController::class, 'store'])->name('reviews.store');

// Route::post('product/{id}/reviews', [ReviewController::class, 'index'])->name('reviews.store');

require __DIR__ . '/auth.php';

require __DIR__ . '/admin.php';
require __DIR__ . '/shop.php';
