<?php

namespace App\Http\Controllers\Store;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuickSalesController extends StoreBaseController
{
    public function index(Request $request): View|JsonResponse
    {
        $store = $this->getStore();
        $query = Order::where('store_id', $store->id)
            ->where('order_type', Order::TYPE_QUICK_SALE)
            ->with(['user', 'city']);

        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qry) use ($q) {
                $qry->where('order_number', 'like', "%{$q}%")
                    ->orWhere('customer_name', 'like', "%{$q}%");
            });
        }

        $orders = $query->latest()->paginate(20);

        if ($request->ajax() || $request->wantsJson()) {
            $lastOrder = $orders->first();
            return response()->json([
                'tbody' => view('store.quick-sales._table-manager', compact('orders'))->render(),
                'pagination' => $orders->links()->render(),
                'last_order_at' => $lastOrder?->created_at->toIso8601String() ?? now()->toIso8601String(),
                'last_order_id' => $lastOrder?->id,
            ]);
        }

        return view('store.quick-sales.index-manager', compact('store', 'orders'));
    }

    public function show(Order $order): View
    {
        $store = $this->getStore();
        if ($order->store_id != $store->id || $order->order_type != Order::TYPE_QUICK_SALE) {
            abort(403, 'Bu satışa erişim yetkiniz yok.');
        }
        $order->load(['items', 'user', 'city', 'statusLogs', 'payments']);

        return view('store.quick-sales.show', compact('store', 'order'));
    }
}
