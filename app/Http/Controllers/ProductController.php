<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\Store;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(
        private CartService $cart
    ) {}

    public function index(string $citySlug): View|RedirectResponse
    {
        $city = City::where('slug', $citySlug)->where('is_active', true)->firstOrFail();
        $store = Store::forCity($city->id);
        if (!$store) {
            return redirect()->route('city.select')->with('error', 'Bu il için mağaza bulunamadı.');
        }
        $this->cart->setCity($city->id);

        $categories = Category::active()
            ->where('store_id', $store->id)
            ->with(['products' => fn($q) => $q->active()->forStore($store->id)->orderBy('sort_order')])
            ->orderBy('sort_order')
            ->get();

        $cartData = $this->cart->getCartData();
        $minOrderAmount = (float) ($store->min_order_amount ?? $city->min_order_amount ?? 0);

        return view('products.index', compact('city', 'categories', 'cartData', 'minOrderAmount'));
    }

    public function addToCart(Request $request): RedirectResponse
    {
        $request->validate(['product_id' => 'required|exists:products,id', 'quantity' => 'nullable|integer|min:1']);
        $cityId = $this->cart->getCityId();
        if (!$cityId) {
            return redirect()->back()->with('error', 'Lütfen önce bir il seçin.');
        }
        $product = Product::findOrFail($request->product_id);
        if (!$product->is_active) {
            return redirect()->back()->with('error', 'Bu ürün şu an mevcut değil.');
        }
        $store = Store::forCity($cityId);
        if (!$store || $product->store_id != $store->id) {
            return redirect()->back()->with('error', 'Bu ürün seçtiğiniz ilde mevcut değil.');
        }
        $this->cart->add($request->product_id, $request->quantity ?? 1);
        return redirect()->back()->with('success', 'Ürün sepete eklendi.');
    }
}
