<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CityController extends Controller
{
    public function index(): View
    {
        $cities = City::orderBy('sort_order')->paginate(20);
        return view('admin.cities.index', compact('cities'));
    }

    public function create(): View
    {
        return view('admin.cities.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'min_order_amount' => 'nullable|numeric|min:0',
        ]);

        City::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->sort_order ?? 0,
            'min_order_amount' => $request->min_order_amount ?? 0,
        ]);

        return redirect()->route('admin.cities.index')->with('success', 'İl eklendi.');
    }

    public function edit(City $city): View
    {
        return view('admin.cities.edit', compact('city'));
    }

    public function update(Request $request, City $city): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'min_order_amount' => 'nullable|numeric|min:0',
        ]);

        $city->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->sort_order ?? 0,
            'min_order_amount' => $request->min_order_amount ?? 0,
        ]);

        return redirect()->route('admin.cities.index')->with('success', 'İl güncellendi.');
    }

    public function destroy(City $city): RedirectResponse
    {
        $city->delete();
        return redirect()->route('admin.cities.index')->with('success', 'İl silindi.');
    }
}
