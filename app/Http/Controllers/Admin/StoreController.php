<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoreController extends Controller
{
    public function index(): View
    {
        $stores = Store::with('city')->orderBy('sort_order')->paginate(20);
        return view('admin.stores.index', compact('stores'));
    }

    public function edit(Store $store): View
    {
        $store->load('city');
        return view('admin.stores.edit', compact('store'));
    }

    public function update(Request $request, Store $store): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'min_order_amount' => 'nullable|numeric|min:0',
            'delivery_fee' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $store->update([
            'name' => $request->name,
            'min_order_amount' => $request->min_order_amount ?? 0,
            'delivery_fee' => $request->delivery_fee ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.stores.index')->with('success', 'Mağaza güncellendi.');
    }
}
