<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PaymentCallbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/iller', [CityController::class, 'select'])->name('city.select');
Route::get('/siparis/{city}', [CityController::class, 'set'])->name('city.set')->where('city', '[a-z0-9\-]+');

Route::get('/siparis/{city}/urunler', [ProductController::class, 'index'])->name('products.index')->where('city', '[a-z0-9\-]+');
Route::post('/sepet/ekle', [ProductController::class, 'addToCart'])->name('cart.add');

Route::get('/sepet', [CartController::class, 'index'])->name('cart.index');
Route::post('/sepet/guncelle', [CartController::class, 'update'])->name('cart.update');
Route::delete('/sepet/{productId}', [CartController::class, 'remove'])->name('cart.remove')->where('productId', '[0-9]+');

Route::get('/odeme', [CheckoutController::class, 'index'])->name('checkout.index')->middleware('auth');
Route::post('/odeme', [CheckoutController::class, 'store'])->name('checkout.store')->middleware('auth');
Route::any('/odeme/callback', [PaymentCallbackController::class, 'handle'])->name('payment.callback');

Route::get('/siparislerim', [OrderController::class, 'index'])->name('orders.index')->middleware('auth');
Route::get('/siparislerim/{order}', [OrderController::class, 'show'])->name('orders.show')->middleware('auth');

Route::get('/dashboard', function () {
    return redirect()->route('orders.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/adresler', [AddressController::class, 'index'])->name('addresses.index');
    Route::get('/adresler/ekle', [AddressController::class, 'create'])->name('addresses.create');
    Route::post('/adresler', [AddressController::class, 'store'])->name('addresses.store');
    Route::get('/adresler/{address}/duzenle', [AddressController::class, 'edit'])->name('addresses.edit');
    Route::patch('/adresler/{address}', [AddressController::class, 'update'])->name('addresses.update');
    Route::delete('/adresler/{address}', [AddressController::class, 'destroy'])->name('addresses.destroy');
});

require __DIR__.'/auth.php';
