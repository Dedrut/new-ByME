<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ByMeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransaksiController;

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

Route::redirect('/', '/home');
Route::get('/produk/{id_produk}', [ByMeController::class, 'detailProduk'])->name('detail-produk');
Route::get('/home', [ByMeController::class, 'index'])->name('home');



Route::get('/produk', function () {
    return view('frontend.produk');
});

Route::get('/keranjang', function () {
    return view('frontend.keranjang');
});

Route::get('/detail', function () {
    return view('frontend.detailProduk');
});




Route::middleware('guest')->group(function () {

    Route::get('/daftar', function () {
        return view('frontend.daftar');
    })->name('register-page');
    Route::post('/daftar', [UserController::class, 'daftar'])->name('register-store');


    Route::get('/login', function () {
        return view('frontend.login');
    })->name('login');
    Route::post('/authenticate', [UserController::class, 'login'])->name('auth');
});
// Route::get('/logging-out', [ByMeController::class, 'logout'])->name('logout')->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/produk', function () {
        return view('frontend.index');
    });
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::post('/logout', [TransaksiController::class, 'storeToCart'])->name('to-cart');


    Route::get('/admin', function () {
        return view('frontend.admin.admin_dashboard');
    });

    Route::get('/admin/order', function () {
        return view('frontend.admin.admin_order');
    })->name('order-page');


    Route::get('/admin/category', [CategoryController::class, 'index'])->name('category-page');
    Route::post('/admin/category', [CategoryController::class, 'store'])->name('add-category');
    Route::get('/admin/category/{id_category}', [CategoryController::class, 'destroy'])->name('update-category');


    Route::get('/admin/product', [ProductController::class, 'index'])->name('product-page');
    Route::post('/admin/product', [ProductController::class, 'store'])->name('add-product');
    Route::get('/admin/product/{id_produk}', [ProductController::class, 'edit'])->name('edit-product');
    Route::post('/admin/product/{id_produk}/update', [ProductController::class, 'update'])->name('update-product');
    Route::delete('/admin/product/{id_produk}/delete', [ProductController::class, 'destroy'])->name('delete-product');
});