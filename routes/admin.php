<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\IntegrationController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/api/new-orders', [NotificationController::class, 'newOrders'])->name('api.new-orders');
    Route::resource('orders', AdminOrderController::class)->only(['index', 'show', 'update']);
    Route::resource('cities', CityController::class);
    Route::get('stores', [StoreController::class, 'index'])->name('stores.index');
    Route::get('stores/{store}/edit', [StoreController::class, 'edit'])->name('stores.edit');
    Route::put('stores/{store}', [StoreController::class, 'update'])->name('stores.update');
    Route::resource('categories', CategoryController::class);
    Route::resource('products', AdminProductController::class);
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::get('integrations', [IntegrationController::class, 'index'])->name('integrations.index');
    Route::get('integrations/iyzico', [IntegrationController::class, 'iyzico'])->name('integrations.iyzico');
    Route::post('integrations/iyzico', [IntegrationController::class, 'updateIyzico'])->name('integrations.iyzico.update');
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index')->middleware('can:roles.view');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create')->middleware('can:roles.create');
    Route::post('roles', [RoleController::class, 'store'])->name('roles.store')->middleware('can:roles.create');
    Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware('can:roles.update');
    Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update')->middleware('can:roles.update');
    Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('can:roles.delete');
    Route::get('activity-log', [ActivityLogController::class, 'index'])->name('activity-log.index')->middleware('can:activity_log.view');
});
