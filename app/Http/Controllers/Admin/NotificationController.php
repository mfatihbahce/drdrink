<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    public function newOrders(): JsonResponse
    {
        $lastId = request()->get('last_id');
        $lastCheck = request()->get('last_check');

        if ($lastId && is_numeric($lastId)) {
            $count = Order::where('id', '>', (int) $lastId)->count();
            $lastOrder = Order::orderBy('id', 'desc')->first();
            return response()->json([
                'count' => $count,
                'has_new' => $count > 0,
                'last_id' => $lastOrder?->id ?? (int) $lastId,
                'last_check' => now()->toIso8601String(),
            ]);
        }

        if (!$lastCheck) {
            return response()->json(['count' => 0, 'has_new' => false]);
        }
        try {
            $lastCheckDate = \Carbon\Carbon::parse($lastCheck);
        } catch (\Exception $e) {
            $lastCheckDate = now()->subSeconds(30);
        }
        $count = Order::where('created_at', '>', $lastCheckDate)->count();
        $lastOrder = Order::orderBy('id', 'desc')->first();
        return response()->json([
            'count' => $count,
            'has_new' => $count > 0,
            'last_id' => $lastOrder?->id,
            'last_check' => now()->toIso8601String(),
        ]);
    }
}
