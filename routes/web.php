<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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


Auth::routes();

// tampilan front end untuk user
Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/b/{kode}', [HomeController::class, 'detailBarang'])->name('home.barang.show');
Route::get('/categories', [HomeController::class, 'kategori'])->name('home.kategori.show.all');
Route::get('/c/{slug}', [HomeController::class, 'kategori'])->name('home.kategori.show');

// user harus login untuk mengakses route ini
Route::middleware('auth')->group(function () {

    Route::get('/home', [DashboardController::class, 'index'])->name('user.home');

    // wishlist
    Route::get('/mywishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/post/wishlist', [WishlistController::class, 'store'])->name('wishlist.add');
    Route::delete('/delete/wishlist/{kode}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    // cart
    Route::get('/mycart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/post/cart', [CartController::class, 'store'])->name('cart.add');
    Route::delete('/delete/cart/{kode}', [CartController::class, 'destroy'])->name('cart.destroy');

    // order
    Route::get('/myorder', [OrderController::class, 'index'])->name('order.index');
    Route::match(['get', 'post'], '/order/checkout', [OrderController::class, 'pembayaran'])->name('order.checkout');
    Route::post('/upload/bukti_pembayaran', [OrderController::class, 'buktiPembayaran'])->name('order.upload.bukti_pembayaran');
    Route::post('/process/order/pengiriman', [OrderController::class, 'invoice'])->name('invoice');
    Route::match(['get', 'post'], '/order/pengiriman', [OrderController::class, 'orderStore'])->name('order.add');
    Route::delete('/delete/order/{kode}', [OrderController::class, 'orderDestroy'])->name('order.destroy');

    // profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/update/password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');


    
});

Route::group(['prefix' => '/admin/', 'middleware' => ['auth', 'role:admin']], function() {
    
    Route::get('/dasboard', [DashboardController::class, 'admin'])->name('admin.home');
    
    // Management Admin
    Route::resource('barang', BarangController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('pesanan', AdminOrderController::class);

    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::put('/setting/update', [SettingController::class, 'update'])->name('setting.update');

});
