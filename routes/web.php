<?php

use App\Http\Controllers\ActionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApiKeyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RoleGroupController;
use App\Http\Controllers\UserGroupController;
use App\Http\Controllers\UserRoleController;

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
    Route::post('/menu', [MenuController::class, 'search'])->name('search');
    Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
    Route::post('/cart', [CartController::class, 'placeOrder'])->name('cart.order');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update', [CartController::class, 'edit'])->name('cart.edit');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/cart/notice/{status}/{message}', [CartController::class, 'notice'])->name('cart.notice');
    Route::get('/orders', [OrderController::class, 'orders'])->name('order.list');
    Route::get('/orders/{id}', [OrderController::class, 'details'])->name('order.detail');

    // Admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        // product routes
        Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.product.list');
        Route::get('/admin/products/delete', [ProductController::class, 'delete'])->name('admin.product.delete');
        Route::get('/admin/products/edit', [ProductController::class, 'update'])->name('admin.product.update');
        Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.product.create');
        Route::get('/admin/products/detail', [ProductController::class, 'detail'])->name('admin.product.detail');

        // category routes
        Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.category.list');
        Route::get('/admin/categories/delete', [CategoryController::class, 'delete'])->name('admin.category.delete');
        Route::get('/admin/categories/edit', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::get('/admin/categories/detail', [CategoryController::class, 'detail'])->name('admin.category.detail');

        // user routes
        Route::get('/admin/users', [UserController::class, 'index'])->name('admin.user.list');
        Route::get('/admin/users/delete', [UserController::class, 'delete'])->name('admin.user.delete');
        Route::get('/admin/users/edit', [UserController::class, 'update'])->name('admin.user.update');
        Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.user.create');
        Route::get('/admin/users/detail', [UserController::class, 'detail'])->name('admin.user.detail');

        // store routes
        Route::get('/admin/stores', [StoreController::class, 'index'])->name('admin.store.list');
        Route::get('/admin/stores/delete', [StoreController::class, 'delete'])->name('admin.store.delete');
        Route::get('/admin/stores/edit', [StoreController::class, 'update'])->name('admin.store.update');
        Route::get('/admin/stores/create', [StoreController::class, 'create'])->name('admin.store.create');
        Route::get('/admin/stores/detail', [StoreController::class, 'detail'])->name('admin.store.detail');

        // order routes
        Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.order.list');
        Route::post('/admin/orders/delete', [OrderController::class, 'delete'])->name('admin.order.delete');
        Route::post('/admin/orders/accept', [OrderController::class, 'acceptOrder'])->name('admin.order.accept');
        Route::post('/admin/orders/reject', [OrderController::class, 'rejectOrder'])->name('admin.order.reject');
        Route::get('/admin/orders/detail/{id}', [OrderController::class, 'detail'])->name('admin.order.detail');
        Route::get('/admin/orders/accepted', [OrderController::class, 'acceptedOrderIndex'])->name('admin.order.accepted.detail');
        Route::get('/admin/orders/rejected', [OrderController::class, 'rejectedOrderIndex'])->name('admin.order.rejected.detail');
        Route::get('/admin/orders/accepted/detail/{id}', [OrderController::class, 'acceptedOrderDetail'])->name('admin.order.accepted.detail');
        Route::post('/admin/orders/accepted/delete/{id}', [OrderController::class, 'acceptedOrderDetail'])->name('admin.order.accepted.delete');
        Route::get('/admin/orders/rejected/detail/{id}', [OrderController::class, 'acceptedOrderDetail'])->name('admin.order.rejected.detail');
        Route::post('/admin/orders/rejected/delete/{id}', [OrderController::class, 'acceptedOrderDetail'])->name('admin.order.rejected.delete');

        // Api-key routes
        Route::get('/admin/api-key', [ApiKeyController::class, 'index'])->name('admin.api.key.list');
        Route::get('/admin/api-key/delete', [ApiKeyController::class, 'delete'])->name('admin.api.key.delete');
        Route::get('/admin/api-key/edit', [ApiKeyController::class, 'update'])->name('admin.api.key.update');
        Route::get('/admin/api-key/create', [ApiKeyController::class, 'create'])->name('admin.api.key.create');
        Route::get('/admin/api-key/detail', [ApiKeyController::class, 'detail'])->name('admin.api.key.detail');

        // User-group routes
        Route::get('/admin/user-group', [UserGroupController::class, 'index'])->name('admin.user.group.list');
        Route::get('/admin/user-group/delete', [UserGroupController::class, 'delete'])->name('admin.user.group.delete');
        Route::get('/admin/user-group/edit', [UserGroupController::class, 'update'])->name('admin.user.group.update');
        Route::get('/admin/user-group/create', [UserGroupController::class, 'create'])->name('admin.user.group.create');
        Route::get('/admin/user-group/detail', [UserGroupController::class, 'detail'])->name('admin.user.group.detail');

        // User-role routes
        Route::get('/admin/user-role', [UserRoleController::class, 'index'])->name('admin.user.role.list');
        Route::get('/admin/user-role/delete', [UserRoleController::class, 'delete'])->name('admin.user.role.delete');
        Route::get('/admin/user-role/edit', [UserRoleController::class, 'update'])->name('admin.user.role.update');
        Route::get('/admin/user-role/create', [UserRoleController::class, 'create'])->name('admin.user.role.create');
        Route::get('/admin/user-role/detail', [UserRoleController::class, 'detail'])->name('admin.user.role.detail');

        // Role-group routes
        Route::get('/admin/role-group', [RoleGroupController::class, 'index'])->name('admin.role.group.list');
        Route::get('/admin/role-group/delete', [RoleGroupController::class, 'delete'])->name('admin.role.group.delete');
        Route::get('/admin/role-group/edit', [RoleGroupController::class, 'update'])->name('admin.role.group.update');
        Route::get('/admin/role-group/create', [RoleGroupController::class, 'create'])->name('admin.role.group.create');
        Route::get('/admin/role-group/detail', [RoleGroupController::class, 'detail'])->name('admin.role.group.detail');

        // Action routes
        Route::get('/admin/action', [ActionController::class, 'index'])->name('admin.action.list');
        Route::get('/admin/action/delete', [ActionController::class, 'delete'])->name('admin.action.delete');
        Route::get('/admin/action/edit', [ActionController::class, 'update'])->name('admin.action.update');
        Route::get('/admin/action/create', [ActionController::class, 'create'])->name('admin.action.create');
        Route::get('/admin/action/detail', [ActionController::class, 'detail'])->name('admin.action.detail');
    });
});


require __DIR__.'/auth.php';
