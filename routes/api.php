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

Route::get('/product/list', [ApiController::class, 'products'])->name('api.product.list');
Route::get('/user/list', [ApiController::class, 'users'])->name('api.user.list');
Route::get('/category/list', [ApiController::class, 'categories'])->name('api.category.list');
Route::get('/store/list', [ApiController::class, 'stores'])->name('api.store.list');
Route::post('/check-connection', [ApiController::class, 'checkConnection'])->name('api.check.connection');

Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::post('/api-key/generate', [ApiKeyController::class, 'generateApiKey'])->name('api.key.generate');
    });
});
