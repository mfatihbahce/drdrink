<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StoreMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $user = auth()->user();
        if ($user->hasStoreAccess()) {
            return $next($request);
        }
        if ($user->hasAnyRole(['Super Admin', 'Yönetici', 'Personel', 'Kasiyer'])) {
            return redirect()->route('admin.dashboard')->with('info', 'Mağaza paneline erişim için mağaza ataması gereklidir.');
        }
        abort(403, 'Mağaza paneline erişim yetkiniz yok.');
    }
}
