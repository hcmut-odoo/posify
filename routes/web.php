<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Guest routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/stores', [HomeController::class, 'stores'])->name('stores');

// User routes
Route::middleware('auth')->group(function () {
    Route::get('/menu', [MenuController::class, 'menu'])->name('menu');
    Route::get('/menu/category/{id}', [MenuController::class, 'category'])->name('category');
    Route::get('/product/{id}', [MenuController::class, 'detail'])->name('detail');
    Route::post('/product/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/menu', [MenuController::class, 'search'])->name('search');
    Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
    Route::post('/cart', [CartController::class, 'placeOrder'])->name('cart.order');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update', [CartController::class, 'edit'])->name('cart.edit');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/cart/notice/{status}/{message}', [CartController::class, 'notice'])->name('cart.notice');
    Route::get('/orders', [OrderController::class, 'orders'])->name('order.list');
    Route::get('/orders/{id}', [OrderController::class, 'details'])->name('order.detail');

    // Admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index']);

        // product routes
        Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.product.list');
        Route::get('/admin/products/delete', [ProductController::class, 'delete'])->name('admin.product.delete');
        Route::get('/admin/products/edit', [ProductController::class, 'update'])->name('admin.product.update');
        Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.product.create');
        Route::get('/admin/products/detail', [ProductController::class, 'detail'])->name('admin.product.detail');

        // category routes
        Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.product.list');
        Route::get('/admin/categories/delete', [CategoryController::class, 'delete'])->name('admin.product.delete');
        Route::get('/admin/categories/edit', [CategoryController::class, 'update'])->name('admin.product.update');
        Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.product.create');
        Route::get('/admin/categories/detail', [CategoryController::class, 'detail'])->name('admin.product.detail');

        // user routes
        Route::get('/admin/users', [UserController::class, 'index'])->name('admin.product.list');
        Route::get('/admin/users/delete', [UserController::class, 'delete'])->name('admin.product.delete');
        Route::get('/admin/users/edit', [UserController::class, 'update'])->name('admin.product.update');
        Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.product.create');
        Route::get('/admin/users/detail', [UserController::class, 'detail'])->name('admin.product.detail');

        // store routes
        Route::get('/admin/stores', [StoreController::class, 'index'])->name('admin.product.list');
        Route::get('/admin/stores/delete', [StoreController::class, 'delete'])->name('admin.product.delete');
        Route::get('/admin/stores/edit', [StoreController::class, 'update'])->name('admin.product.update');
        Route::get('/admin/stores/create', [StoreController::class, 'create'])->name('admin.product.create');
        Route::get('/admin/stores/detail', [StoreController::class, 'detail'])->name('admin.product.detail');
    });
});


require __DIR__.'/auth.php';
