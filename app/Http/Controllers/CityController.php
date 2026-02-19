<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CityController extends Controller
{
    public function __construct(
        private CartService $cart
    ) {}

    public function select(): View
    {
        $cities = City::active()->orderBy('sort_order')->get();
        return view('city-select', compact('cities'));
    }

    public function set(City $city): RedirectResponse
    {
        if (!$city->is_active) {
            return redirect()->route('city.select')->with('error', 'Bu ilde şu an hizmet verilmemektedir.');
        }
        $previousCityId = $this->cart->getCityId();
        $cityActuallyChanged = $previousCityId !== null && (int) $previousCityId !== (int) $city->id;
        $hadItems = $this->cart->count() > 0;

        $this->cart->setCity($city->id);
        $redirect = redirect()->route('products.index', $city->slug);

        if ($cityActuallyChanged && $hadItems) {
            $redirect->with('success', 'İl değiştirildi. Önceki sepetiniz temizlendi.');
        }
        return $redirect;
    }
}
