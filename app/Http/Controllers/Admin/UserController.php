<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::query()->with(['roles', 'stores' => fn($q) => $q->with('city')]);

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qry) use ($q) {
                $qry->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%");
            });
        }

        $users = $query->latest()->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        $roles = Role::orderBy('name')->get();
        $stores = Store::with('city')->orderBy('name')->get();
        return view('admin.users.create', compact('roles', 'stores'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:50',
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => 'nullable|exists:roles,name',
            'store_ids' => 'nullable|array',
            'store_ids.*' => 'exists:stores,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
        ]);

        if ($request->filled('role')) {
            $user->assignRole($request->role);
        }

        if ($request->filled('store_ids')) {
            $pivotRole = $request->role === 'Kasiyer' ? 'cashier' : 'manager';
            foreach ($request->store_ids as $storeId) {
                $user->stores()->attach($storeId, ['role' => $pivotRole]);
            }
        }

        return redirect()->route('admin.users.index')->with('success', 'Kullanıcı oluşturuldu.');
    }

    public function edit(User $user): View
    {
        $roles = Role::orderBy('name')->get();
        $stores = Store::with('city')->orderBy('name')->get();
        $user->load('stores');
        return view('admin.users.edit', compact('user', 'roles', 'stores'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:50',
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'role' => 'nullable|exists:roles,name',
            'store_ids' => 'nullable|array',
            'store_ids.*' => 'exists:stores,id',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => $request->password]);
        }

        $user->syncRoles($request->role ? [$request->role] : []);

        $user->stores()->detach();
        if ($request->filled('store_ids')) {
            $pivotRole = $request->role === 'Kasiyer' ? 'cashier' : 'manager';
            foreach ($request->store_ids as $storeId) {
                $user->stores()->attach($storeId, ['role' => $pivotRole]);
            }
        }

        return redirect()->route('admin.users.index')->with('success', 'Kullanıcı güncellendi.');
    }
}
