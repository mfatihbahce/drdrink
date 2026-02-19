<?php

use App\Http\Controllers\Store\CategoryController as StoreCategoryController;
use App\Http\Controllers\Store\DashboardController as StoreDashboardController;
use App\Http\Controllers\Store\NotificationController as StoreNotificationController;
use App\Http\Controllers\Store\OrderController as StoreOrderController;
use App\Http\Controllers\Store\PosController as StorePosController;
use App\Http\Controllers\Store\QuickSalesController as StoreQuickSalesController;
use App\Http\Controllers\Store\ProductController as StoreProductController;
use App\Http\Controllers\Store\SettingsController as StoreSettingsController;
use App\Http\Controllers\Store\UserController as StoreUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('magaza')->name('store.')->middleware(['auth', 'store', 'store.cashier'])->group(function () {
    Route::get('/', [StoreDashboardController::class, 'index'])->name('dashboard');
    Route::get('/pos', [StorePosController::class, 'index'])->name('pos.index');
    Route::post('/pos/sepet/ekle', [StorePosController::class, 'addToCart'])->name('pos.cart.add');
    Route::post('/pos/sepet/guncelle', [StorePosController::class, 'updateCart'])->name('pos.cart.update');
    Route::post('/pos/sepet/sil', [StorePosController::class, 'removeFromCart'])->name('pos.cart.remove');
    Route::post('/pos/sepet/temizle', [StorePosController::class, 'clearCart'])->name('pos.cart.clear');
    Route::post('/pos/satis-tamamla', [StorePosController::class, 'completeSale'])->name('pos.complete');
    Route::get('/api/new-orders', [StoreNotificationController::class, 'newOrders'])->name('api.new-orders');
    Route::resource('orders', StoreOrderController::class)->only(['index', 'show', 'update']);

    Route::resource('categories', StoreCategoryController::class);
    Route::resource('products', StoreProductController::class);
    Route::get('ayarlar', [StoreSettingsController::class, 'index'])->name('settings.index');
    Route::post('ayarlar', [StoreSettingsController::class, 'update'])->name('settings.update');

    Route::middleware('store.manager')->group(function () {
        Route::get('hizli-satislar', [StoreQuickSalesController::class, 'index'])->name('quick-sales.index');
        Route::get('hizli-satislar/{order}', [StoreQuickSalesController::class, 'show'])->name('quick-sales.show');
        Route::get('kullanicilar', [StoreUserController::class, 'index'])->name('users.index');
        Route::get('kullanicilar/ekle', [StoreUserController::class, 'create'])->name('users.create');
        Route::post('kullanicilar', [StoreUserController::class, 'store'])->name('users.store');
    });
});
