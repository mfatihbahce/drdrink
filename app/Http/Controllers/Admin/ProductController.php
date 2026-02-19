<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::with(['category', 'store']);
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->store_id) {
            $query->where('store_id', $request->store_id);
        }
        $products = $query->orderBy('sort_order')->paginate(20);
        $categories = Category::with('store')->orderBy('name')->get();
        $stores = \App\Models\Store::with('city')->orderBy('name')->get();
        return view('admin.products.index', compact('products', 'categories', 'stores'));
    }

    public function create(): View
    {
        $categories = Category::with('store')->orderBy('name')->get();
        $stores = \App\Models\Store::with('city')->orderBy('name')->get();
        return view('admin.products.create', compact('categories', 'stores'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'store_id' => 'required|exists:stores,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $category = Category::findOrFail($request->category_id);
        if ($category->store_id != $request->store_id) {
            return redirect()->back()->with('error', 'Kategori seçilen mağazaya ait olmalıdır.')->withInput();
        }

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . $request->store_id,
            'category_id' => $request->category_id,
            'store_id' => $request->store_id,
            'description' => $request->description,
            'price' => $request->price,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Ürün eklendi.');
    }

    public function edit(Product $product): View
    {
        $categories = Category::where('store_id', $product->store_id)->orderBy('name')->get();
        $stores = \App\Models\Store::with('city')->orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories', 'stores'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'store_id' => 'required|exists:stores,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $category = Category::findOrFail($request->category_id);
        if ($category->store_id != $request->store_id) {
            return redirect()->back()->with('error', 'Kategori seçilen mağazaya ait olmalıdır.')->withInput();
        }

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . $request->store_id,
            'category_id' => $request->category_id,
            'store_id' => $request->store_id,
            'description' => $request->description,
            'price' => $request->price,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Ürün güncellendi.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Ürün silindi.');
    }
}
