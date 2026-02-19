<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\PendingCheckout;
use App\Models\Store;
use App\Services\CartService;
use App\Services\IyzicoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentCallbackController extends Controller
{
    public function __construct(
        private IyzicoService $iyzico,
        private CartService $cart
    ) {}

    public function handle(Request $request): RedirectResponse
    {
        $token = $request->input('token');
        if (!$token) {
            return $this->redirectWithError('Ödeme işlemi geçersiz.');
        }

        $result = $this->iyzico->retrieveCheckoutForm($token, $request->input('conversationId', ''));
        $basketId = $result['basket_id'] ?? '';

        $pendingCheckout = PendingCheckout::where('order_number', $basketId)->first();
        if (!$pendingCheckout) {
            \Log::warning('Payment callback: pending checkout not found', ['basket_id' => $basketId]);
            return $this->redirectWithError('Ödeme oturumu geçersiz veya süresi doldu. Sepetiniz aynen duruyor.');
        }

        if ($pendingCheckout->created_at->diffInMinutes(now()) > 60) {
            $pendingCheckout->delete();
            return $this->redirectWithError('Ödeme oturumunun süresi doldu. Sepetiniz aynen duruyor.');
        }

        if (auth()->check() && (int) $pendingCheckout->user_id !== auth()->id()) {
            return redirect()->route('home')->with('error', 'Bu ödemeye erişim yetkiniz yok.');
        }

        if (!auth()->check()) {
            Auth::loginUsingId($pendingCheckout->user_id);
        }

        $paymentStatus = $result['payment_status'] ?? '';
        $isSuccess = $paymentStatus === 'SUCCESS'
            || $paymentStatus === 'success'
            || $paymentStatus === 1
            || $paymentStatus === '1';

        if ($isSuccess) {
            DB::beginTransaction();
            try {
                $store = Store::forCity($pendingCheckout->city_id);
                $order = Order::create([
                    'user_id' => $pendingCheckout->user_id,
                    'city_id' => $pendingCheckout->city_id,
                    'store_id' => $store?->id,
                    'order_number' => $pendingCheckout->order_number,
                    'status' => Order::STATUS_PENDING,
                    'address' => $pendingCheckout->address,
                    'phone' => $pendingCheckout->phone,
                    'customer_name' => $pendingCheckout->customer_name,
                    'notes' => $pendingCheckout->notes,
                    'subtotal' => $pendingCheckout->subtotal,
                    'delivery_fee' => $pendingCheckout->delivery_fee,
                    'total' => $pendingCheckout->total,
                    'payment_status' => Order::PAYMENT_PAID,
                    'payment_method' => 'credit_card',
                ]);

                foreach ($pendingCheckout->cart_items as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['product_id'],
                        'product_name' => $item['product_name'],
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'total' => $item['total'],
                    ]);
                }

                $order->statusLogs()->create([
                    'status' => Order::STATUS_PENDING,
                    'updated_by' => $order->user_id,
                    'notes' => 'Sipariş oluşturuldu (ödeme alındı)',
                ]);

                Payment::create([
                    'order_id' => $order->id,
                    'payment_id' => $result['payment_id'] ?? null,
                    'status' => $result['payment_status'] ?? 'SUCCESS',
                    'amount' => $result['paid_price'] ?? $order->total,
                    'response' => $result,
                ]);

                $this->cart->clear();
                $pendingCheckout->delete();
                DB::commit();

                return redirect()->route('orders.show', $order)
                    ->with('success', 'Ödemeniz alındı. Siparişiniz hazırlanacaktır.');
            } catch (\Exception $e) {
                DB::rollBack();
                \Log::error('Payment callback: order creation failed', ['error' => $e->getMessage(), 'pending_id' => $pendingCheckout->id]);
                return $this->redirectWithError('Sipariş oluşturulurken bir hata oluştu. Lütfen destek ile iletişime geçin.');
            }
        }

        $pendingCheckout->delete();
        \Log::warning('Iyzico callback: payment not success', ['payment_status' => $paymentStatus, 'basket_id' => $basketId]);

        return $this->redirectWithError($result['error_message'] ?? 'Ödeme işlemi başarısız veya iptal edildi. Ürünleriniz sepette duruyor.');
    }

    private function redirectWithError(string $message): RedirectResponse
    {
        if (auth()->check() && $this->cart->getCityId()) {
            return redirect()->route('cart.index')->with('error', $message);
        }
        return redirect()->route('city.select')->with('error', $message);
    }
}
