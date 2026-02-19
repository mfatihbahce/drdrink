<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\UserAddress;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AddressController extends Controller
{
    public function index(): View
    {
        $addresses = auth()->user()->addresses()->with('city')->orderByDesc('is_default')->orderBy('title')->get();
        return view('addresses.index', compact('addresses'));
    }

    public function create(): View
    {
        $cities = City::active()->orderBy('sort_order')->get();
        return view('addresses.create', compact('cities'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'city_id' => 'required|exists:cities,id',
            'district' => 'required|string|max:100',
            'neighborhood' => 'required|string|max:100',
            'street' => 'required|string|max:100',
            'avenue' => 'nullable|string|max:100',
            'building' => 'required|string|max:50',
            'apartment' => 'nullable|string|max:50',
            'address_instructions' => 'nullable|string|max:500',
            'is_default' => 'nullable|boolean',
        ]);

        if ($request->boolean('is_default')) {
            auth()->user()->addresses()->update(['is_default' => false]);
        }

        $city = City::find($request->city_id);
        $addressStr = self::buildAddressString($city?->name, $request->district, $request->neighborhood, $request->street, $request->avenue, $request->building, $request->apartment);

        auth()->user()->addresses()->create([
            'title' => $request->title,
            'city_id' => $request->city_id,
            'district' => $request->district,
            'neighborhood' => $request->neighborhood,
            'street' => $request->street,
            'avenue' => $request->avenue,
            'building' => $request->building,
            'apartment' => $request->apartment,
            'address' => $addressStr,
            'address_instructions' => $request->address_instructions,
            'is_default' => $request->boolean('is_default'),
        ]);

        return redirect()->route('addresses.index')->with('success', 'Adres eklendi.');
    }

    public function edit(UserAddress $address): View|RedirectResponse
    {
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }
        $cities = City::active()->orderBy('sort_order')->get();
        return view('addresses.edit', compact('address', 'cities'));
    }

    public function update(Request $request, UserAddress $address): RedirectResponse
    {
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:100',
            'city_id' => 'required|exists:cities,id',
            'district' => 'required|string|max:100',
            'neighborhood' => 'required|string|max:100',
            'street' => 'required|string|max:100',
            'avenue' => 'nullable|string|max:100',
            'building' => 'required|string|max:50',
            'apartment' => 'nullable|string|max:50',
            'address_instructions' => 'nullable|string|max:500',
            'is_default' => 'nullable|boolean',
        ]);

        if ($request->boolean('is_default')) {
            auth()->user()->addresses()->where('id', '!=', $address->id)->update(['is_default' => false]);
        }

        $city = City::find($request->city_id);
        $addressStr = self::buildAddressString($city?->name, $request->district, $request->neighborhood, $request->street, $request->avenue, $request->building, $request->apartment);

        $address->update([
            'title' => $request->title,
            'city_id' => $request->city_id,
            'district' => $request->district,
            'neighborhood' => $request->neighborhood,
            'street' => $request->street,
            'avenue' => $request->avenue,
            'building' => $request->building,
            'apartment' => $request->apartment,
            'address' => $addressStr,
            'address_instructions' => $request->address_instructions,
            'is_default' => $request->boolean('is_default'),
        ]);

        return redirect()->route('addresses.index')->with('success', 'Adres güncellendi.');
    }

    public function destroy(UserAddress $address): RedirectResponse
    {
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }
        $address->delete();
        return redirect()->route('addresses.index')->with('success', 'Adres silindi.');
    }

    private static function buildAddressString(?string $city, ?string $district, ?string $neighborhood, ?string $street, ?string $avenue, ?string $building, ?string $apartment): string
    {
        $streetPart = trim(($street ?? '') . ' ' . ($avenue ?? ''));
        $parts = array_filter([
            $city,
            $district,
            $neighborhood,
            $streetPart,
            $building ? 'No: ' . $building : null,
            $apartment ? 'Daire: ' . $apartment : null,
        ]);
        return implode(', ', $parts) ?: '';
    }
}
