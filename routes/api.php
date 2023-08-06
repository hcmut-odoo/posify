<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiKeyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('api.key')->group(function () {
// });

Route::post('/check-connection', [ApiController::class, 'checkConnection'])->name('api.check.connection');

Route::prefix('/user')->group(function () {
    Route::post('/create', [ApiController::class, 'createUser'])->name('api.user.create');
    Route::get('/find/{id}', [ApiController::class, 'getUserById'])->name('api.user.find.id');
    Route::get('/find', [ApiController::class, 'getUser'])->name('api.user.find');
    Route::get('/list', [ApiController::class, 'users'])->name('api.user.list');
    Route::post('/update/{id}', [ApiController::class, 'updateUser'])->name('api.user.update');
    Route::post('/delete/{id}', [ApiController::class, 'deleteUser'])->name('api.user.delete');
    Route::get('/address/{id}', [ApiController::class, 'getUserAddress'])->name('api.user.address');
});


Route::prefix('/address')->group(function () {
    Route::get('/find/{id}', [ApiController::class, 'getUserAddressById'])->name('api.address.find.id');
    Route::get('/find', [ApiController::class, 'getUserAddress'])->name('api.address.find');
});

Route::prefix('/product')->group(function () {
    Route::post('/create', [ApiController::class, 'createProduct'])->name('api.product.create');
    Route::get('/find/{id}', [ApiController::class, 'getProduct'])->name('api.product.find');
    Route::get('/list', [ApiController::class, 'products'])->name('api.product.list');
    Route::post('/update/{id}', [ApiController::class, 'updateProduct'])->name('api.product.update');
    Route::post('/delete/{id}', [ApiController::class, 'deleteProduct'])->name('api.product.delete');
});

Route::prefix('/category')->group(function () {
    Route::post('/create', [ApiController::class, 'createCategory'])->name('api.category.create');
    Route::get('/find/{id}', [ApiController::class, 'getCategory'])->name('api.category.find.v1');
    Route::get('/find', [ApiController::class, 'getCategory'])->name('api.category.find.v2');
    Route::get('/list', [ApiController::class, 'categories'])->name('api.category.list');
    Route::post('/update/{id}', [ApiController::class, 'updateCategory'])->name('api.category.update.v1');
    Route::post('/update', [ApiController::class, 'updateCategory'])->name('api.category.update.v2');
    Route::post('/delete/{id}', [ApiController::class, 'deleteCategory'])->name('api.category.delete.v1');
    Route::post('/delete', [ApiController::class, 'deleteCategory'])->name('api.category.delete.v2');
});

Route::prefix('/store')->group(function () {
    Route::post('/create', [ApiController::class, 'createStore'])->name('api.store.create');
    Route::get('/find/{id}', [ApiController::class, 'getStore'])->name('api.store.find');;
    Route::get('/list', [ApiController::class, 'stores'])->name('api.store.list');
    Route::get('/update/{id}', [ApiController::class, 'updateStore'])->name('api.store.update');
    Route::get('/delete/{id}', [ApiController::class, 'deleteStore'])->name('api.store.delete');
});

Route::prefix('/order')->group(function () {
    Route::get('/find/{id}', [ApiController::class, 'getOrder'])->name('api.order.find');;
    Route::get('/list', [ApiController::class, 'orders'])->name('api.order.list');
    Route::get('/accept/{id}', [ApiController::class, 'acceptOrder'])->name('api.order.accept');
    Route::get('/reject/{id}', [ApiController::class, 'deleteOrder'])->name('api.order.reject');
    Route::get('/accepted/list', [ApiController::class, 'acceptedOrders'])->name('api.order.accepted.list');
    Route::get('/rejected/list', [ApiController::class, 'rejectedOrders'])->name('api.order.rejected.list');
});

Route::prefix('/invoice')->group(function () {
    Route::get('/find/{id}', [ApiController::class, 'getInvoice'])->name('api.invoice.find');;
    Route::get('/list', [ApiController::class, 'invoices'])->name('api.invoice.list');
});

Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::post('/api-key/generate', [ApiKeyController::class, 'generateApiKey'])->name('api.key.generate');
    });
});
