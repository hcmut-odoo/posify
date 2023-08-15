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
use App\Http\Controllers\InvoiceController;

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
    Route::post('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/cart/notice/{status}/{message}', [CartController::class, 'notice'])->name('cart.notice');
    Route::get('/orders', [OrderController::class, 'orders'])->name('order.list');
    Route::get('/orders/{id}', [OrderController::class, 'userViewOrderDetail'])->name('order.detail');

    // Admin routes
    Route::middleware('admin')->prefix('/admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        // product routes
        Route::prefix('/products')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('admin.product.list');
            Route::get('/delete', [ProductController::class, 'deleteProduct'])->name('admin.product.delete');
            Route::get('/edit', [ProductController::class, 'updateProduct'])->name('admin.product.update');
            Route::get('/create', [ProductController::class, 'createProduct'])->name('admin.product.create');
            Route::get('/detail', [ProductController::class, 'detailProduct'])->name('admin.product.detail');
        });

        // category routes
        Route::prefix('/categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('admin.category.list');
            Route::get('/delete', [CategoryController::class, 'deleteCategory'])->name('admin.category.delete');
            Route::get('/edit', [CategoryController::class, 'updateCategory'])->name('admin.category.update');
            Route::get('/create', [CategoryController::class, 'createCategory'])->name('admin.category.create');
            Route::get('/detail', [CategoryController::class, 'detailCategory'])->name('admin.category.detail');
        });

        // user routes
        Route::prefix('/users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('admin.user.list');
            Route::post('/delete/{id}', [UserController::class, 'deleteUser'])->name('admin.user.delete');
            Route::get('/update/{id}', [UserController::class, 'updateUser'])->name('admin.user.update.get');
            Route::post('/update/{id}', [UserController::class, 'updateUser'])->name('admin.user.update.post');
            Route::post('/create', [UserController::class, 'createUser'])->name('admin.user.create');
            Route::get('/view/{id}', [UserController::class, 'viewUser'])->name('admin.user.view');
        });

        // store routes
        Route::prefix('/stores')->group(function () {
            Route::get('/', [StoreController::class, 'index'])->name('admin.store.list');
            Route::get('/delete', [StoreController::class, 'deleteStore'])->name('admin.store.delete');
            Route::get('/edit', [StoreController::class, 'updateStore'])->name('admin.store.update');
            Route::get('/create', [StoreController::class, 'createStore'])->name('admin.store.create');
            Route::get('/detail', [StoreController::class, 'detailStore'])->name('admin.store.detail');
        });

        // order routes
        Route::prefix('/orders')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('admin.order.list');
            Route::post('/delete', [OrderController::class, 'deleteOrder'])->name('admin.order.delete');
            Route::post('/accept', [OrderController::class, 'acceptOrder'])->name('admin.order.accept');
            Route::post('/reject', [OrderController::class, 'rejectOrder'])->name('admin.order.reject');
            Route::get('/detail/{id}', [OrderController::class, 'adminViewOrderDetail'])->name('admin.order.detail');
            Route::get('/accepted', [OrderController::class, 'acceptedOrderIndex'])->name('admin.order.accepted');
            Route::get('/rejected', [OrderController::class, 'rejectedOrderIndex'])->name('admin.order.rejected');
            Route::get('/accepted/detail/{id}', [OrderController::class, 'acceptedOrderDetail'])->name('admin.order.accepted.detail');
            Route::post('/accepted/delete/{id}', [OrderController::class, 'acceptedOrderDetail'])->name('admin.order.accepted.delete');
            Route::get('/rejected/detail/{id}', [OrderController::class, 'acceptedOrderDetail'])->name('admin.order.rejected.detail');
            Route::post('/rejected/delete/{id}', [OrderController::class, 'acceptedOrderDetail'])->name('admin.order.rejected.delete');
        });

        // invoice routes
        Route::prefix('/invoices')->group(function () {
            Route::get('/', [InvoiceController::class, 'index'])->name('admin.invoice.list');
            Route::post('/delete', [InvoiceController::class, 'deleteInvoice'])->name('admin.invoice.delete');
            Route::get('/detail/{id}', [InvoiceController::class, 'invoiceDetail'])->name('admin.invoice.detail');
            Route::get('/print/{id}', [InvoiceController::class, 'invoiceForm'])->name('admin.invoice.form');
        });

        // Api-key routes
        Route::prefix('/api-key')->group(function () {
            Route::get('/', [ApiKeyController::class, 'index'])->name('admin.api.key.list');
            Route::get('/delete', [ApiKeyController::class, 'deleteKey'])->name('admin.api.key.delete');
            Route::get('/edit', [ApiKeyController::class, 'updateKey'])->name('admin.api.key.update');
            Route::get('/create', [ApiKeyController::class, 'createKey'])->name('admin.api.key.create');
            Route::get('/detail', [ApiKeyController::class, 'detailKey'])->name('admin.api.key.detail');
            Route::get('/inactive', [ApiKeyController::class, 'inactiveKey'])->name('admin.api.key.inactive');
        });

        // User-group routes
        Route::prefix('/user-group')->group(function() {
            Route::get('/', [UserGroupController::class, 'index'])->name('admin.user.group.list');
            Route::get('/delete', [UserGroupController::class, 'delete'])->name('admin.user.group.delete');
            Route::get('/edit', [UserGroupController::class, 'update'])->name('admin.user.group.update');
            Route::get('/create', [UserGroupController::class, 'create'])->name('admin.user.group.create');
            Route::get('/detail', [UserGroupController::class, 'detail'])->name('admin.user.group.detail');
        });

        // User-role routes
        Route::prefix('/user-role')->group(function() {
            Route::get('/', [UserRoleController::class, 'index'])->name('admin.user.role.list');
            Route::get('/delete', [UserRoleController::class, 'delete'])->name('admin.user.role.delete');
            Route::get('/edit', [UserRoleController::class, 'update'])->name('admin.user.role.update');
            Route::get('/create', [UserRoleController::class, 'create'])->name('admin.user.role.create');
            Route::get('/detail', [UserRoleController::class, 'detail'])->name('admin.user.role.detail');
        });

        // Role-group routes
        Route::prefix('/role-group')->group(function() {
            Route::get('/', [RoleGroupController::class, 'index'])->name('admin.role.group.list');
            Route::get('/delete', [RoleGroupController::class, 'delete'])->name('admin.role.group.delete');
            Route::get('/edit', [RoleGroupController::class, 'update'])->name('admin.role.group.update');
            Route::get('/create', [RoleGroupController::class, 'create'])->name('admin.role.group.create');
            Route::get('/detail', [RoleGroupController::class, 'detail'])->name('admin.role.group.detail');
        });

        // Action routes
        Route::prefix('/action')->group(function() {
            Route::get('/', [ActionController::class, 'index'])->name('admin.action.list');
            Route::get('/delete', [ActionController::class, 'delete'])->name('admin.action.delete');
            Route::get('/edit', [ActionController::class, 'update'])->name('admin.action.update');
            Route::get('/create', [ActionController::class, 'create'])->name('admin.action.create');
            Route::get('/detail', [ActionController::class, 'detail'])->name('admin.action.detail');
        });
    });
});


require __DIR__.'/auth.php';
