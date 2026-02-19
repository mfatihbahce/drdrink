<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StoreCashierMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()->hasRole('Kasiyer')) {
            return $next($request);
        }
        if ($request->routeIs('store.api.new-orders', 'store.orders.*', 'store.pos.*')) {
            return $next($request);
        }
        if ($request->routeIs('store.dashboard')) {
            return redirect()->route('store.orders.index');
        }
        abort(403, 'Bu sayfaya erişim yetkiniz yok.');
    }
}
