<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsController extends StoreBaseController
{
    public function index(): View
    {
        $store = $this->getStore();
        return view('store.settings.index', compact('store'));
    }

    public function update(Request $request): RedirectResponse
    {
        $store = $this->getStore();
        $request->validate([
            'min_order_amount' => 'nullable|numeric|min:0',
            'delivery_fee' => 'nullable|numeric|min:0',
        ]);

        $store->update([
            'min_order_amount' => $request->min_order_amount ?? 0,
            'delivery_fee' => $request->delivery_fee ?? 0,
        ]);

        return redirect()->route('store.settings.index')->with('success', 'Ayarlar güncellendi.');
    }
}
