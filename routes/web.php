<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ImageUploadController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [MenuController::class, 'menu'])->name('menu');
Route::get('/menu/category/{id}', [MenuController::class, 'category'])->name('category');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/stores', [HomeController::class, 'stores'])->name('stores');
Route::get('/product/{id}', [MenuController::class, 'detail'])->name('detail');
Route::post('/product/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/menu', [MenuController::class, 'search'])->name('search');
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart', [CartController::class, 'show'])->name('cart.post');
Route::post('/cart/{id}/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/{id}/update', [CartController::class, 'edit'])->name('cart.edit');
Route::get('/upload', [ImageUploadController::class, 'imageUpload'])->name('image.upload');
Route::get('/upload/{bucket}/{image}', [ImageUploadController::class, 'getPreSignedUrl'])->name('image.get');
Route::post('/upload', [ImageUploadController::class, 'imageUploadPost'])->name('image.upload.post');

require __DIR__.'/auth.php';
