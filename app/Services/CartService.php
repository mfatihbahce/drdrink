<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    const SESSION_KEY = 'drdrink_cart';
    const CITY_KEY = 'drdrink_city';

    public function getCityId(): ?int
    {
        return Session::get(self::CITY_KEY);
    }

    public function setCity(int $cityId): void
    {
        $currentCityId = $this->getCityId();
        if ($currentCityId !== null && $currentCityId !== $cityId) {
            $this->clear();
        }
        Session::put(self::CITY_KEY, $cityId);
    }

    public function getItems(): array
    {
        return Session::get(self::SESSION_KEY, []);
    }

    public function add(int $productId, int $quantity = 1): bool
    {
        $product = Product::find($productId);
        if (!$product || !$product->is_active) return false;

        $items = $this->getItems();
        $key = (string) $productId;
        $items[$key] = ($items[$key] ?? 0) + $quantity;
        Session::put(self::SESSION_KEY, $items);
        return true;
    }

    public function update(int $productId, int $quantity): bool
    {
        if ($quantity <= 0) {
            return $this->remove($productId);
        }
        $product = Product::find($productId);
        if (!$product) return false;

        $items = $this->getItems();
        $items[(string) $productId] = $quantity;
        Session::put(self::SESSION_KEY, $items);
        return true;
    }

    public function remove(int $productId): bool
    {
        $items = $this->getItems();
        unset($items[(string) $productId]);
        Session::put(self::SESSION_KEY, $items);
        return true;
    }

    public function clear(): void
    {
        Session::forget(self::SESSION_KEY);
    }

    public function count(): int
    {
        return array_sum($this->getItems());
    }

    public function getCartData(): array
    {
        $items = $this->getItems();
        if (empty($items)) return ['items' => [], 'subtotal' => 0, 'count' => 0];

        $products = Product::whereIn('id', array_keys($items))->get()->keyBy('id');
        $cartItems = [];
        $subtotal = 0;

        foreach ($items as $productId => $qty) {
            $product = $products->get($productId);
            if (!$product) continue;
            $total = $product->price * $qty;
            $cartItems[] = [
                'product' => $product,
                'quantity' => $qty,
                'total' => $total,
            ];
            $subtotal += $total;
        }

        return [
            'items' => $cartItems,
            'subtotal' => $subtotal,
            'count' => array_sum($items),
        ];
    }
}
