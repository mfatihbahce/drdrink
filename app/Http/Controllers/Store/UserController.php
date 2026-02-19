<?php

namespace App\Http\Controllers\Store;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class UserController extends StoreBaseController
{
    public function index(): View
    {
        $store = $this->getStore();
        $users = $store->users()->with('roles')->orderBy('name')->get();

        return view('store.users.index', compact('store', 'users'));
    }

    public function create(): View
    {
        $store = $this->getStore();

        return view('store.users.create', compact('store'));
    }

    public function store(Request $request): RedirectResponse
    {
        $store = $this->getStore();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:50',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
        ]);

        $user->assignRole('Kasiyer');
        $user->stores()->attach($store->id, ['role' => 'cashier']);

        return redirect()->route('store.users.index')->with('success', 'Kasiyer kullanıcısı oluşturuldu.');
    }
}
