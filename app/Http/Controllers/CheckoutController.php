<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Order;
use App\Models\Store;
use App\Models\OrderItem;
use App\Models\PendingCheckout;
use App\Services\CartService;
use App\Services\IyzicoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function __construct(
        private CartService $cart,
        private IyzicoService $iyzico
    ) {}

    public function index(): View|RedirectResponse
    {
        if (!$this->cart->getCityId()) {
            return redirect()->route('city.select')->with('error', 'Lütfen önce bir il seçin.');
        }
        $cartData = $this->cart->getCartData();
        if (empty($cartData['items'])) {
            return redirect()->route('city.select')->with('error', 'Sepetiniz boş.');
        }
        $city = City::find($this->cart->getCityId());
        $store = Store::forCity($city->id);
        if (!$store) {
            return redirect()->route('city.select')->with('error', 'Bu il için mağaza bulunamadı.');
        }
        $deliveryFee = (float) ($store->delivery_fee ?? 15.00);
        $total = $cartData['subtotal'] + $deliveryFee;
        $minOrderAmount = (float) ($store->min_order_amount ?? $city->min_order_amount ?? 0);
        if ($minOrderAmount > 0 && $total < $minOrderAmount) {
            return redirect()->route('cart.index')->with('error', "{$city->name} için minimum sipariş tutarı " . number_format($minOrderAmount, 2) . " ₺. Sepet tutarınız: " . number_format($total, 2) . " ₺");
        }
        $addresses = auth()->user()->addresses()->orderByDesc('is_default')->orderBy('title')->get();
        return view('checkout.index', compact('cartData', 'city', 'deliveryFee', 'total', 'addresses', 'minOrderAmount'));
    }

    public function store(Request $request): RedirectResponse
    {
        $hasAddresses = auth()->user()->addresses()->exists();
        $rules = [
            'customer_name' => 'required|string',
            'notes' => 'nullable|string',
        ];
        if ($hasAddresses) {
            $rules['address_id'] = ['required', Rule::exists('user_addresses', 'id')->where('user_id', auth()->id())];
        } else {
            $rules['address'] = 'required|string';
        }
        $request->validate($rules);

        if ($request->address_id) {
            $userAddress = auth()->user()->addresses()->find($request->address_id);
            $deliveryAddress = $userAddress ? $userAddress->full_address : '';
        } else {
            $deliveryAddress = $request->address ?? '';
        }
        if (empty($deliveryAddress)) {
            return redirect()->back()->withErrors(['address' => 'Teslimat adresi gereklidir.'])->withInput();
        }

        $phone = $request->phone ?? auth()->user()->phone;

        $cartData = $this->cart->getCartData();
        if (empty($cartData['items'])) {
            return redirect()->route('city.select')->with('error', 'Sepetiniz boş.');
        }

        $city = City::find($this->cart->getCityId());
        if (!$city) {
            return redirect()->route('city.select')->with('error', 'Lütfen il seçin.');
        }
        $store = Store::forCity($city->id);
        if (!$store) {
            return redirect()->route('city.select')->with('error', 'Bu il için mağaza bulunamadı.');
        }

        $deliveryFee = (float) ($store->delivery_fee ?? 15.00);
        $subtotal = $cartData['subtotal'];
        $total = $subtotal + $deliveryFee;

        $minOrderAmount = (float) ($store->min_order_amount ?? $city->min_order_amount ?? 0);
        if ($minOrderAmount > 0 && $total < $minOrderAmount) {
            return redirect()->route('cart.index')->with('error', "{$city->name} için minimum sipariş tutarı " . number_format($minOrderAmount, 2) . " ₺. Sepet tutarınız: " . number_format($total, 2) . " ₺");
        }

        if (config('services.iyzico.api_key')) {
            $orderNumber = Order::generateOrderNumber();
            $orderData = [
                'order_number' => $orderNumber,
                'user_id' => auth()->id(),
                'customer_name' => $request->customer_name,
                'phone' => $phone,
                'email' => auth()->user()->email,
                'address' => $deliveryAddress,
                'city_name' => $city->name,
                'subtotal' => $subtotal,
                'delivery_fee' => $deliveryFee,
                'total' => $total,
                'callback_url' => route('payment.callback'),
                'items' => array_map(fn($i) => [
                    'name' => $i['product']->name,
                    'price' => (float) $i['product']->price,
                    'quantity' => $i['quantity'],
                ], $cartData['items']),
            ];

            $iyzicoResult = $this->iyzico->initializeCheckout($orderData);

            if ($iyzicoResult['status'] === 'success' && !empty($iyzicoResult['payment_page_url'])) {
                PendingCheckout::create([
                    'order_number' => $orderNumber,
                    'user_id' => auth()->id(),
                    'city_id' => $city->id,
                    'address' => $deliveryAddress,
                    'phone' => $phone,
                    'customer_name' => $request->customer_name,
                    'notes' => $request->notes,
                    'subtotal' => $subtotal,
                    'delivery_fee' => $deliveryFee,
                    'total' => $total,
                    'cart_items' => array_map(fn($i) => [
                        'product_id' => $i['product']->id,
                        'product_name' => $i['product']->name,
                        'price' => (float) $i['product']->price,
                        'quantity' => $i['quantity'],
                        'total' => (float) $i['total'],
                    ], $cartData['items']),
                ]);
                return redirect()->away($iyzicoResult['payment_page_url']);
            }

            $errorMsg = !empty($iyzicoResult['error_message']) ? $iyzicoResult['error_message'] : 'Ödeme sayfası oluşturulamadı. Lütfen API anahtarlarınızı kontrol edin.';
            \Log::warning('Iyzico checkout failed', ['result' => $iyzicoResult]);
            return redirect()->back()->with('error', 'Ödeme işlemi başlatılamadı: ' . $errorMsg)->withInput();
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'city_id' => $city->id,
                'store_id' => $store->id,
                'order_number' => Order::generateOrderNumber(),
                'status' => Order::STATUS_PENDING,
                'address' => $deliveryAddress,
                'phone' => $phone,
                'customer_name' => $request->customer_name,
                'notes' => $request->notes,
                'subtotal' => $subtotal,
                'delivery_fee' => $deliveryFee,
                'total' => $total,
                'payment_status' => Order::PAYMENT_PENDING,
                'payment_method' => 'credit_card',
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

            $order->statusLogs()->create([
                'status' => Order::STATUS_PENDING,
                'updated_by' => auth()->id(),
                'notes' => 'Sipariş oluşturuldu',
            ]);

            $this->cart->clear();
            DB::commit();
            return redirect()->route('orders.show', $order->id)
                ->with('success', 'Siparişiniz alındı.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Sipariş oluşturulurken bir hata oluştu: ' . $e->getMessage());
        }
    }
}
