<?php

namespace App\Http\Controllers\Store;

use App\Models\Order;
use Illuminate\Http\JsonResponse;

class NotificationController extends StoreBaseController
{
    public function newOrders(): JsonResponse
    {
        $store = $this->getStore();
        $lastId = request()->get('last_id');
        $lastCheck = request()->get('last_check');

        $baseQuery = Order::where('store_id', $store->id)
            ->where(function ($q) {
                $q->where('order_type', '!=', Order::TYPE_QUICK_SALE)->orWhereNull('order_type');
            });

        if ($lastId && is_numeric($lastId)) {
            $count = (clone $baseQuery)->where('id', '>', (int) $lastId)->count();
            $lastOrder = (clone $baseQuery)->orderBy('id', 'desc')->first();
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
        $count = (clone $baseQuery)->where('created_at', '>', $lastCheckDate)->count();
        $lastOrder = (clone $baseQuery)->orderBy('id', 'desc')->first();
        return response()->json([
            'count' => $count,
            'has_new' => $count > 0,
            'last_id' => $lastOrder?->id,
            'last_check' => now()->toIso8601String(),
        ]);
    }
}
