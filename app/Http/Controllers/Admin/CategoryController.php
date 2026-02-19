<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $query = Category::with('store')->orderBy('sort_order');
        if ($request->store_id) {
            $query->where('store_id', $request->store_id);
        }
        $categories = $query->paginate(20);
        $stores = Store::with('city')->orderBy('name')->get();
        return view('admin.categories.index', compact('categories', 'stores'));
    }

    public function create(): View
    {
        $stores = Store::with('city')->orderBy('name')->get();
        return view('admin.categories.create', compact('stores'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'store_id' => 'required|exists:stores,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        Category::create([
            'store_id' => $request->store_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . $request->store_id,
            'description' => $request->description,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori eklendi.');
    }

    public function edit(Category $category): View
    {
        $category->load('store');
        $stores = Store::with('city')->orderBy('name')->get();
        return view('admin.categories.edit', compact('category', 'stores'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $request->validate([
            'store_id' => 'required|exists:stores,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $category->update([
            'store_id' => $request->store_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . $request->store_id,
            'description' => $request->description,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori güncellendi.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Kategori silindi.');
    }
}
