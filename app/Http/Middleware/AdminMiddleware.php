<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        if (!auth()->user()->hasAnyRole(['Super Admin', 'Yönetici', 'Personel', 'Kasiyer'])) {
            abort(403, 'Bu sayfaya erişim yetkiniz yok.');
        }
        if (auth()->user()->hasRole('Kasiyer') && !$request->routeIs('admin.dashboard', 'admin.api.new-orders', 'admin.orders.*')) {
            abort(403, 'Bu sayfaya erişim yetkiniz yok.');
        }
        return $next($request);
    }
}
