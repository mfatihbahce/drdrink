<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Route::bind('role', fn($value) => Role::findOrFail($value));

        View::composer(['store.layouts.app', 'store.layouts.pos'], function ($view) {
            $store = null;
            if (auth()->check()) {
                $store = auth()->user()->managedStore() ?? auth()->user()->stores()->first();
            }
            $view->with('store', $store);
        });
    }
}
