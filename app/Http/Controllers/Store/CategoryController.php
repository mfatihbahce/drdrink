<?php

namespace App\Http\Controllers\Store;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends StoreBaseController
{
    public function index(): View
    {
        $store = $this->getStore();
        $categories = Category::where('store_id', $store->id)->orderBy('sort_order')->paginate(20);

        return view('store.categories.index', compact('store', 'categories'));
    }

    public function create(): View
    {
        $store = $this->getStore();
        return view('store.categories.create', compact('store'));
    }

    public function store(Request $request): RedirectResponse
    {
        $store = $this->getStore();
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        Category::create([
            'store_id' => $store->id,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . $store->id,
            'description' => $request->description,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('store.categories.index')->with('success', 'Kategori eklendi.');
    }

    public function edit(Category $category): View|RedirectResponse
    {
        $store = $this->getStore();
        if ($category->store_id != $store->id) {
            abort(403, 'Bu kategoriye erişim yetkiniz yok.');
        }
        return view('store.categories.edit', compact('store', 'category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $store = $this->getStore();
        if ($category->store_id != $store->id) {
            abort(403, 'Bu kategoriye erişim yetkiniz yok.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('store.categories.index')->with('success', 'Kategori güncellendi.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $store = $this->getStore();
        if ($category->store_id != $store->id) {
            abort(403, 'Bu kategoriye erişim yetkiniz yok.');
        }
        $category->delete();
        return redirect()->route('store.categories.index')->with('success', 'Kategori silindi.');
    }
}
