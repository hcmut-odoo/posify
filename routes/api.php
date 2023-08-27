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
    Route::get('/search', [ApiController::class, 'searchUsers'])->name('api.user.search');
    Route::get('/list', [ApiController::class, 'users'])->name('api.user.list');
    Route::post('/update', [ApiController::class, 'updateUser'])->name('api.user.update');
    Route::post('/delete', [ApiController::class, 'deleteUser'])->name('api.user.delete');
    Route::get('/address', [ApiController::class, 'getUserAddress'])->name('api.user.address');
    Route::post('/update/{id}', [ApiController::class, 'updateUserById'])->name('api.user.update.id');
    Route::post('/delete/{id}', [ApiController::class, 'deleteUserById'])->name('api.user.delete.id');
    Route::get('/address/{id}', [ApiController::class, 'getUserAddressById'])->name('api.user.address.id');
});


Route::prefix('/address')->group(function () {
    Route::get('/find/{id}', [ApiController::class, 'getUserAddressById'])->name('api.address.find.id');
    Route::get('/find', [ApiController::class, 'getUserAddress'])->name('api.address.find');
});

Route::prefix('/product')->group(function () {
    Route::post('/create', [ApiController::class, 'createProduct'])->name('api.product.create');
    Route::get('/list', [ApiController::class, 'products'])->name('api.product.list');
    Route::get('/find', [ApiController::class, 'getProduct'])->name('api.product.find');
    Route::get('/search', [ApiController::class, 'searchProducts'])->name('api.product.search');
    Route::post('/update', [ApiController::class, 'updateProduct'])->name('api.product.update');
    Route::post('/delete', [ApiController::class, 'deleteProduct'])->name('api.product.delete');
    Route::post('/update/{id}', [ApiController::class, 'updateProductById'])->name('api.product.update.id');
    Route::post('/delete/{id}', [ApiController::class, 'deleteProductById'])->name('api.product.delete.id');
    Route::get('/find/{id}', [ApiController::class, 'getProductById'])->name('api.product.find.id');
});

Route::prefix('/product_variant')->group(function () {
    Route::post('/create', [ApiController::class, 'createProductVariant'])->name('api.product.variant.create');
    Route::get('/list', [ApiController::class, 'productVariants'])->name('api.product.variant.list');
    Route::get('/find', [ApiController::class, 'getProductVariant'])->name('api.product.variant.find');
    Route::post('/update', [ApiController::class, 'updateProductVariant'])->name('api.product.variant.update');
    Route::post('/delete', [ApiController::class, 'deleteProductVariant'])->name('api.product.variant.delete');
    Route::get('/find/{id}', [ApiController::class, 'getProductVariantById'])->name('api.product.variant.find.id');
});

Route::prefix('/category')->group(function () {
    Route::post('/create', [ApiController::class, 'createCategory'])->name('api.category.create');
    Route::get('/find/{id}', [ApiController::class, 'getCategoryById'])->name('api.category.find.v1');
    Route::get('/find', [ApiController::class, 'getCategory'])->name('api.category.find.v2');
    Route::get('/list', [ApiController::class, 'categories'])->name('api.category.list');
    Route::get('/search', [ApiController::class, 'searchCategories'])->name('api.category.search');
    Route::post('/update/{id}', [ApiController::class, 'updateCategory'])->name('api.category.update.v1');
    Route::post('/update', [ApiController::class, 'updateCategory'])->name('api.category.update.v2');
    Route::post('/delete/{id}', [ApiController::class, 'deleteCategory'])->name('api.category.delete.v1');
    Route::post('/delete', [ApiController::class, 'deleteCategory'])->name('api.category.delete.v2');
});

Route::prefix('/store')->group(function () {
    Route::post('/create', [ApiController::class, 'createStore'])->name('api.store.create');
    Route::get('/find', [ApiController::class, 'getStore'])->name('api.store.find');;
    Route::get('/list', [ApiController::class, 'stores'])->name('api.store.list');
    Route::get('/search', [ApiController::class, 'searchStores'])->name('api.store.search');
    Route::get('/update', [ApiController::class, 'updateStore'])->name('api.store.update');
    Route::get('/delete', [ApiController::class, 'deleteStore'])->name('api.store.delete');
    Route::get('/find/{id}', [ApiController::class, 'getStoreById'])->name('api.store.find');;
    Route::get('/update/{id}', [ApiController::class, 'updateStoreById'])->name('api.store.update');
    Route::get('/delete/{id}', [ApiController::class, 'deleteStoreById'])->name('api.store.delete');
});

Route::prefix('/order')->group(function () {
    Route::get('/find/{id}', [ApiController::class, 'getOrderById'])->name('api.order.find.id');
    Route::get('/find', [ApiController::class, 'getOrderDetail'])->name('api.order.find');
    Route::get('/list', [ApiController::class, 'orders'])->name('api.order.list');
    Route::get('/search', [ApiController::class, 'searchOrders'])->name('api.order.search');
    Route::get('/accept', [ApiController::class, 'acceptOrder'])->name('api.order.accept');
    Route::get('/reject', [ApiController::class, 'rejectOrder'])->name('api.order.reject');
    Route::get('/accepted/list', [ApiController::class, 'acceptedOrders'])->name('api.order.accepted.list');
    Route::get('/rejected/list', [ApiController::class, 'rejectedOrders'])->name('api.order.rejected.list');
    Route::get('/accept/{id}', [ApiController::class, 'acceptOrderById'])->name('api.order.accept.id');
    Route::get('/reject/{id}', [ApiController::class, 'rejectOrderById'])->name('api.order.reject.id');
});

Route::prefix('/cart_item')->group(function () {
    Route::get('/find/{id}', [ApiController::class, 'getCartItemsById'])->name('api.order.item.find.id');
    Route::get('/find', [ApiController::class, 'getCartItems'])->name('api.order.item.find');;
    Route::get('/list', [ApiController::class, 'cartItems'])->name('api.cart.item.list');
    Route::get('/search', [ApiController::class, 'searchCartItems'])->name('api.cart.item.search');
});

Route::prefix('/order_item')->group(function () {
    Route::get('/find', [ApiController::class, 'getOrderItems'])->name('api.order.item.find');
    Route::get('/list', [ApiController::class, 'orderItems'])->name('api.order.item.list');
    Route::get('/search', [ApiController::class, 'searchOrderItems'])->name('api.order.item.search');
});

Route::prefix('/invoice')->group(function () {
    Route::get('/find', [ApiController::class, 'getInvoice'])->name('api.invoice.find');
    Route::get('/list', [ApiController::class, 'invoices'])->name('api.invoice.list');
    Route::get('/search', [ApiController::class, 'searchInvoices'])->name('api.invoice.search');
    Route::get('/find/{id}', [ApiController::class, 'getInvoiceById'])->name('api.invoice.find.id');
});

Route::prefix('/payment')->group(function () {
    Route::get('/find', [ApiController::class, 'getPaymentMode'])->name('api.payment.find');
    Route::get('/list', [ApiController::class, 'paymentModes'])->name('api.payment.list');
    Route::get('/search', [ApiController::class, 'searchPaymentModes'])->name('api.payment.search');
    Route::get('/find/{id}', [ApiController::class, 'getPaymentModeById'])->name('api.payment.find.id');
});

Route::prefix('/tax')->group(function () {
    Route::get('/find', [ApiController::class, 'getTax'])->name('api.tax.find');
    Route::get('/list', [ApiController::class, 'taxes'])->name('api.tax.list');
    Route::get('/search', [ApiController::class, 'searchTaxes'])->name('api.tax.search');
    Route::get('/find/{id}', [ApiController::class, 'getTaxById'])->name('api.tax.find.id');
});

Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::post('/api-key/generate', [ApiKeyController::class, 'generateApiKey'])->name('api.key.generate');
    });
});
