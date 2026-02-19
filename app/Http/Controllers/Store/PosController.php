<?php

namespace App\Http\Controllers\Store;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatusLog;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PosController extends StoreBaseController
{
    public function __construct(
        private CartService $cart
    ) {}

    public function index(): View|RedirectResponse
    {
        $store = $this->getStore();
        $store->load('city');

        $this->cart->setCity($store->city_id);

        $categories = Category::active()
            ->where('store_id', $store->id)
            ->with(['products' => fn($q) => $q->active()->forStore($store->id)->orderBy('sort_order')])
            ->orderBy('sort_order')
            ->get();

        $cartData = $this->cart->getCartData();

        return view('store.pos.index', compact('store', 'categories', 'cartData'));
    }

    public function addToCart(Request $request): JsonResponse
    {
        $store = $this->getStore();
        $request->validate(['product_id' => 'required|exists:products,id', 'quantity' => 'nullable|integer|min:1']);

        $product = \App\Models\Product::findOrFail($request->product_id);
        if (!$product->is_active || $product->store_id != $store->id) {
            return response()->json(['success' => false, 'message' => 'Ürün mevcut değil.'], 400);
        }

        $this->cart->setCity($store->city_id);
        $this->cart->add($request->product_id, $request->quantity ?? 1);

        return response()->json(['success' => true, 'cart' => $this->formatCartForPos()]);
    }

    public function updateCart(Request $request): JsonResponse
    {
        $store = $this->getStore();
        $request->validate(['product_id' => 'required|exists:products,id', 'quantity' => 'required|integer|min:0']);

        $this->cart->setCity($store->city_id);
        $this->cart->update($request->product_id, $request->quantity);

        return response()->json(['success' => true, 'cart' => $this->formatCartForPos()]);
    }

    public function removeFromCart(Request $request): JsonResponse
    {
        $store = $this->getStore();
        $request->validate(['product_id' => 'required|exists:products,id']);

        $this->cart->setCity($store->city_id);
        $this->cart->remove($request->product_id);

        return response()->json(['success' => true, 'cart' => $this->formatCartForPos()]);
    }

    public function clearCart(): JsonResponse
    {
        $store = $this->getStore();
        $this->cart->setCity($store->city_id);
        $this->cart->clear();

        return response()->json(['success' => true, 'cart' => $this->formatCartForPos()]);
    }

    private function formatCartForPos(): array
    {
        $cartData = $this->cart->getCartData();
        return [
            'items' => array_map(fn($i) => [
                'product_id' => $i['product']->id,
                'name' => $i['product']->name,
                'price' => (float) $i['product']->price,
                'quantity' => $i['quantity'],
                'total' => (float) $i['total'],
            ], $cartData['items']),
            'subtotal' => (float) $cartData['subtotal'],
            'count' => (int) $cartData['count'],
        ];
    }

    public function completeSale(Request $request): JsonResponse|RedirectResponse
    {
        $store = $this->getStore();
        $store->load('city');

        $request->validate([
            'customer_name' => 'nullable|string|max:255',
            'discount_type' => 'nullable|string|in:none,pct,fixed',
            'discount_value' => 'nullable|numeric|min:0',
            'payments' => 'required|array|min:1',
            'payments.*.method' => 'required|string|in:nakit,kart,yemek_karti,diger',
            'payments.*.amount' => 'required|numeric|min:0',
        ]);

        $cartData = $this->cart->getCartData();
        if (empty($cartData['items'])) {
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Sepet boş.'], 400);
            }
            return redirect()->route('store.pos.index')->with('error', 'Sepet boş.');
        }

        $subtotal = $cartData['subtotal'];
        $discountAmount = 0;
        $discountType = $request->discount_type ?: 'none';

        if ($discountType === 'pct' || $discountType === 'percentage') {
            $pct = (float) ($request->discount_value ?? 0);
            $discountAmount = round($subtotal * $pct / 100, 2);
        } elseif ($discountType === 'fixed') {
            $discountAmount = min((float) ($request->discount_value ?? 0), $subtotal);
        }

        $total = max(0, round($subtotal - $discountAmount, 2));

        $payments = $request->payments;
        $totalPaid = array_sum(array_column($payments, 'amount'));
        if ($totalPaid < $total) {
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Ödeme tutarı yetersiz.'], 400);
            }
            return redirect()->route('store.pos.index')->with('error', 'Ödeme tutarı yetersiz.');
        }

        $paymentMethods = array_filter(array_map(fn($p) => [
            'method' => $p['method'],
            'amount' => (float) $p['amount'],
        ], $payments), fn($p) => $p['amount'] > 0);

        if (empty($paymentMethods)) {
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'En az bir ödeme girin.'], 400);
            }
            return redirect()->route('store.pos.index')->with('error', 'En az bir ödeme girin.');
        }

        $primaryMethod = $paymentMethods[0]['method'];
        $methodLabels = [
            'nakit' => 'Nakit',
            'kart' => 'Kredi/Banka Kartı',
            'yemek_karti' => 'Yemek Kartı',
            'diger' => 'Diğer',
        ];
        $notesParts = array_map(fn($p) => ($methodLabels[$p['method']] ?? $p['method']) . ': ' . number_format($p['amount'], 2) . ' ₺', $paymentMethods);
        $notes = 'Hızlı satış - ' . implode(', ', $notesParts);
        if ($discountAmount > 0) {
            $notes .= ' | İndirim: ' . number_format($discountAmount, 2) . ' ₺';
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'city_id' => $store->city_id,
                'store_id' => $store->id,
                'order_number' => Order::generateOrderNumber(),
                'status' => Order::STATUS_CONFIRMED,
                'address' => $store->name . ' - Mağaza',
                'phone' => auth()->user()->phone ?? '',
                'customer_name' => $request->customer_name ?: 'Mağaza Müşterisi',
                'notes' => $notes,
                'subtotal' => $subtotal,
                'delivery_fee' => 0,
                'discount_amount' => $discountAmount,
                'discount_type' => $discountType === 'none' ? null : $discountType,
                'total' => $total,
                'payment_status' => Order::PAYMENT_PAID,
                'payment_method' => $primaryMethod,
                'order_type' => Order::TYPE_QUICK_SALE,
            ]);

            foreach ($cartData['items'] as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']->id,
                    'product_name' => $item['product']->name,
                    'price' => $item['product']->price,
                    'quantity' => $item['quantity'],
                    'total' => $item['total'],
                ]);
            }

            foreach ($paymentMethods as $payment) {
                \App\Models\Payment::create([
                    'order_id' => $order->id,
                    'payment_id' => null,
                    'status' => 'paid',
                    'amount' => $payment['amount'],
                    'currency' => 'TRY',
                    'payment_method' => $payment['method'],
                ]);
            }

            OrderStatusLog::create([
                'order_id' => $order->id,
                'status' => Order::STATUS_CONFIRMED,
                'updated_by' => auth()->id(),
                'notes' => $notes,
            ]);

            $this->cart->clear();
            DB::commit();

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'order_number' => $order->order_number,
                    'total' => $total,
                ]);
            }
            return redirect()->route('store.pos.index')
                ->with('success', "Satış tamamlandı. Sipariş No: {$order->order_number}");
        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
            return redirect()->route('store.pos.index')->with('error', 'Hata: ' . $e->getMessage());
        }
    }
}
