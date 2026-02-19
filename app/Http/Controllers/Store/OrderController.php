<?php

namespace App\Http\Controllers\Store;

use App\Models\Order;
use App\Services\IyzicoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends StoreBaseController
{
    public function __construct(private IyzicoService $iyzico) {}

    public function index(Request $request): View|JsonResponse
    {
        $store = $this->getStore();
        $query = Order::where('store_id', $store->id)
            ->where(function ($q) {
                $q->where('order_type', '!=', Order::TYPE_QUICK_SALE)->orWhereNull('order_type');
            })
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
            $tablePartial = auth()->user()->hasRole('Kasiyer') ? 'store.orders._table' : 'store.orders._table-manager';
            return response()->json([
                'tbody' => view($tablePartial, compact('orders'))->render(),
                'pagination' => $orders->links()->render(),
                'last_order_at' => $lastOrder?->created_at->toIso8601String() ?? now()->toIso8601String(),
                'last_order_id' => $lastOrder?->id,
            ]);
        }

        $view = auth()->user()->hasRole('Kasiyer') ? 'store.orders.index' : 'store.orders.index-manager';
        return view($view, compact('store', 'orders'));
    }

    public function show(Order $order): View|RedirectResponse
    {
        $store = $this->getStore();
        if ($order->store_id != $store->id) {
            abort(403, 'Bu siparişe erişim yetkiniz yok.');
        }
        $order->load(['items', 'user', 'city', 'statusLogs']);

        return view('store.orders.show', compact('store', 'order'));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $store = $this->getStore();
        if ($order->store_id != $store->id) {
            abort(403, 'Bu siparişe erişim yetkiniz yok.');
        }

        $request->validate(['status' => 'required|in:' . implode(',', array_keys(Order::getStatusLabels()))]);

        $oldStatus = $order->status;
        $newStatus = $request->status;

        if ($newStatus === Order::STATUS_CANCELLED && $order->payment_status === Order::PAYMENT_PAID) {
            $payment = $order->payments()->whereNotNull('payment_id')->first();
            if ($payment && $payment->payment_id) {
                $refundResult = $this->iyzico->refund(
                    $payment->payment_id,
                    (float) $payment->amount,
                    $order->order_number
                );
                if ($refundResult['success']) {
                    $order->update(['status' => $newStatus, 'payment_status' => Order::PAYMENT_REFUNDED]);
                    $order->statusLogs()->create([
                        'status' => $newStatus,
                        'updated_by' => auth()->id(),
                        'notes' => ($request->notes ?: '') . ' (İyzico iade işlemi başarılı)',
                    ]);
                    return redirect()->back()->with('success', 'Sipariş iptal edildi ve ödeme iade edildi.');
                }
                return redirect()->back()->with('error', 'İade işlemi başarısız.');
            }
        }

        $order->update(['status' => $newStatus]);
        $order->statusLogs()->create([
            'status' => $newStatus,
            'updated_by' => auth()->id(),
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Sipariş durumu güncellendi.');
    }
}
