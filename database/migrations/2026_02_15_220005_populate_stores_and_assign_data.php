<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $cities = DB::table('cities')->get();
        $cityToStore = [];

        foreach ($cities as $city) {
            $storeId = DB::table('stores')->insertGetId([
                'city_id' => $city->id,
                'name' => $city->name . ' Mağazası',
                'slug' => $city->slug . '-magaza',
                'min_order_amount' => DB::table('cities')->where('id', $city->id)->value('min_order_amount') ?? 0,
                'delivery_fee' => 0,
                'is_active' => $city->is_active ?? true,
                'sort_order' => $city->sort_order ?? 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $cityToStore[$city->id] = $storeId;
        }

        $firstStoreId = $cityToStore[$cities->first()->id] ?? DB::table('stores')->min('id');
        $categories = DB::table('categories')->get();
        $catMap = [];

        foreach ($categories as $cat) {
            if ($cat->store_id) {
                continue;
            }
            DB::table('categories')->where('id', $cat->id)->update(['store_id' => $firstStoreId]);
            $catMap[$cat->id] = [$firstStoreId => $cat->id];
        }

        foreach ($cities as $city) {
            $storeId = $cityToStore[$city->id];
            if ($storeId == $firstStoreId) {
                continue;
            }
            foreach ($categories as $cat) {
                $newId = DB::table('categories')->insertGetId([
                    'store_id' => $storeId,
                    'name' => $cat->name,
                    'slug' => $cat->slug . '-' . $storeId,
                    'description' => $cat->description,
                    'image' => $cat->image,
                    'is_active' => $cat->is_active,
                    'sort_order' => $cat->sort_order,
                    'created_at' => $cat->created_at,
                    'updated_at' => now(),
                ]);
                $catMap[$cat->id][$storeId] = $newId;
            }
        }

        foreach (DB::table('products')->get() as $product) {
            $storeId = $product->city_id ? ($cityToStore[$product->city_id] ?? $firstStoreId) : $firstStoreId;
            $newCatId = $catMap[$product->category_id][$storeId] ?? $product->category_id;
            DB::table('products')->where('id', $product->id)->update([
                'store_id' => $storeId,
                'category_id' => $newCatId,
            ]);
        }

        foreach (DB::table('orders')->get() as $order) {
            $storeId = $cityToStore[$order->city_id] ?? $firstStoreId;
            DB::table('orders')->where('id', $order->id)->update(['store_id' => $storeId]);
        }
    }

    public function down(): void
    {
        // Data migration - no rollback
    }
};
