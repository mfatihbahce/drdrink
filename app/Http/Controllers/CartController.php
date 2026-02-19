<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Store;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(
        private CartService $cart
    ) {}

    public function index(): View|RedirectResponse
    {
        if (!$this->cart->getCityId()) {
            return redirect()->route('city.select')->with('error', 'Lütfen önce bir il seçin.');
        }
        $cartData = $this->cart->getCartData();
        $city = City::find($this->cart->getCityId());
        $store = $city ? Store::forCity($city->id) : null;

        $deliveryFee = (float) ($store->delivery_fee ?? 15.00);
        $estimatedTotal = $cartData['subtotal'] + $deliveryFee;
        $minOrderAmount = (float) ($store->min_order_amount ?? $city?->min_order_amount ?? 0);
        $meetsMinimum = $minOrderAmount <= 0 || $estimatedTotal >= $minOrderAmount;

        return view('cart.index', compact('cartData', 'city', 'deliveryFee', 'estimatedTotal', 'minOrderAmount', 'meetsMinimum'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
        ]);
        $this->cart->update($request->product_id, $request->quantity);
        return redirect()->back()->with('success', 'Sepet güncellendi.');
    }

    public function remove(int $productId): RedirectResponse
    {
        $this->cart->remove($productId);
        return redirect()->back()->with('success', 'Ürün sepetten çıkarıldı.');
    }
}
