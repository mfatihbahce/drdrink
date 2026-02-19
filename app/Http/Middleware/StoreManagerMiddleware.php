<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StoreManagerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()->managedStore()) {
            abort(403, 'Bu sayfaya erişim yetkiniz yok. Sadece mağaza yöneticileri kullanıcı ekleyebilir.');
        }
        return $next($request);
    }
}
