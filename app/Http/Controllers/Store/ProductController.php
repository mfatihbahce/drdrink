<?php

namespace App\Http\Controllers\Store;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends StoreBaseController
{
    public function index(Request $request): View
    {
        $store = $this->getStore();
        $query = Product::where('store_id', $store->id)->with('category');

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->orderBy('sort_order')->paginate(20);
        $categories = Category::where('store_id', $store->id)->orderBy('name')->get();

        return view('store.products.index', compact('store', 'products', 'categories'));
    }

    public function create(): View
    {
        $store = $this->getStore();
        $categories = Category::where('store_id', $store->id)->orderBy('name')->get();

        return view('store.products.create', compact('store', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $store = $this->getStore();
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $category = Category::findOrFail($request->category_id);
        if ($category->store_id != $store->id) {
            return redirect()->back()->with('error', 'Geçersiz kategori.')->withInput();
        }

        Product::create([
            'store_id' => $store->id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . $store->id,
            'description' => $request->description,
            'price' => $request->price,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('store.products.index')->with('success', 'Ürün eklendi.');
    }

    public function edit(Product $product): View|RedirectResponse
    {
        $store = $this->getStore();
        if ($product->store_id != $store->id) {
            abort(403, 'Bu ürüne erişim yetkiniz yok.');
        }
        $categories = Category::where('store_id', $store->id)->orderBy('name')->get();

        return view('store.products.edit', compact('store', 'product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $store = $this->getStore();
        if ($product->store_id != $store->id) {
            abort(403, 'Bu ürüne erişim yetkiniz yok.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $category = Category::findOrFail($request->category_id);
        if ($category->store_id != $store->id) {
            return redirect()->back()->with('error', 'Geçersiz kategori.')->withInput();
        }

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('store.products.index')->with('success', 'Ürün güncellendi.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $store = $this->getStore();
        if ($product->store_id != $store->id) {
            abort(403, 'Bu ürüne erişim yetkiniz yok.');
        }
        $product->delete();
        return redirect()->route('store.products.index')->with('success', 'Ürün silindi.');
    }
}
