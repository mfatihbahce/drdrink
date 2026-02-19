<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\IyzicoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct(private IyzicoService $iyzico) {}
    public function index(Request $request): View|JsonResponse
    {
        $orders = $this->getOrdersQuery($request)->latest()->paginate(20);

        if ($request->ajax() || $request->wantsJson()) {
            $lastOrder = $orders->first();
            return response()->json([
                'tbody' => view('admin.orders._table', compact('orders'))->render(),
                'pagination' => $orders->links()->render(),
                'last_order_at' => $lastOrder?->created_at->toIso8601String() ?? now()->toIso8601String(),
                'last_order_id' => $lastOrder?->id,
            ]);
        }

        return view('admin.orders.index', compact('orders'));
    }

    private function getOrdersQuery(Request $request)
    {
        $query = Order::with(['user', 'city']);
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->city) {
            $query->where('city_id', $request->city);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qry) use ($q) {
                $qry->where('order_number', 'like', "%{$q}%")
                    ->orWhere('customer_name', 'like', "%{$q}%");
            });
        }
        return $query;
    }

    public function show(Order $order): View
    {
        $order->load(['items', 'user', 'city', 'statusLogs']);
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
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
                    activity()
                        ->causedBy(auth()->user())
                        ->performedOn($order)
                        ->withProperties(['old_status' => $oldStatus, 'new_status' => $newStatus, 'refunded' => true])
                        ->log('Sipariş iptal edildi ve ödeme iyzico üzerinden iade edildi.');
                    return redirect()->back()->with('success', 'Sipariş iptal edildi ve ödeme kullanıcıya iade edildi.');
                }
                \Log::error('Iyzico refund failed', [
                    'order_id' => $order->id,
                    'payment_id' => $payment->payment_id,
                    'error' => $refundResult['error_message'] ?? 'Bilinmeyen hata',
                ]);
                return redirect()->back()->with('error', 'İade işlemi başarısız: ' . ($refundResult['error_message'] ?? 'Lütfen iyzico panelinden manuel iade yapın.'));
            }
        }

        $order->update(['status' => $newStatus]);
        $order->statusLogs()->create([
            'status' => $newStatus,
            'updated_by' => auth()->id(),
            'notes' => $request->notes,
        ]);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($order)
            ->withProperties(['old_status' => $oldStatus, 'new_status' => $newStatus])
            ->log('Sipariş durumu güncellendi');

        return redirect()->back()->with('success', 'Sipariş durumu güncellendi.');
    }
}
