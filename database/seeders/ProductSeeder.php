<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all()->keyBy('slug');
        $kutahya = City::where('slug', 'kutahya')->first();

        $products = [
            ['category' => 'sicak-kahveler', 'name' => 'Türk Kahvesi', 'price' => 45.00],
            ['category' => 'sicak-kahveler', 'name' => 'Filtre Kahve', 'price' => 55.00],
            ['category' => 'sicak-kahveler', 'name' => 'Americano', 'price' => 60.00],
            ['category' => 'sicak-kahveler', 'name' => 'Latte', 'price' => 75.00],
            ['category' => 'sicak-kahveler', 'name' => 'Cappuccino', 'price' => 70.00],
            ['category' => 'sicak-kahveler', 'name' => 'Mocha', 'price' => 80.00],
            ['category' => 'sicak-kahveler', 'name' => 'Espresso', 'price' => 50.00],
            ['category' => 'sicak-kahveler', 'name' => 'Sütlü Türk Kahvesi', 'price' => 50.00],
            ['category' => 'soguk-kahveler', 'name' => 'Buzlu Americano', 'price' => 65.00],
            ['category' => 'soguk-kahveler', 'name' => 'Buzlu Latte', 'price' => 80.00],
            ['category' => 'soguk-kahveler', 'name' => 'Cold Brew', 'price' => 70.00],
            ['category' => 'soguk-kahveler', 'name' => 'Frappuccino', 'price' => 85.00],
            ['category' => 'caylar', 'name' => 'Çay', 'price' => 25.00],
            ['category' => 'caylar', 'name' => 'Yeşil Çay', 'price' => 30.00],
            ['category' => 'caylar', 'name' => 'Earl Grey', 'price' => 35.00],
            ['category' => 'caylar', 'name' => 'Sıcak Çikolata', 'price' => 55.00],
            ['category' => 'icecekler', 'name' => 'Taze Sıkılmış Portakal Suyu', 'price' => 65.00],
            ['category' => 'icecekler', 'name' => 'Limonata', 'price' => 45.00],
            ['category' => 'icecekler', 'name' => 'Ayran', 'price' => 25.00],
            ['category' => 'icecekler', 'name' => 'Soda', 'price' => 20.00],
            ['category' => 'atistirmaliklar', 'name' => 'Kurabiye', 'price' => 35.00],
            ['category' => 'atistirmaliklar', 'name' => 'Pasta Dilimi', 'price' => 55.00],
            ['category' => 'atistirmaliklar', 'name' => 'Sandviç', 'price' => 65.00],
        ];

        foreach ($products as $p) {
            $category = $categories->get($p['category']);
            if (!$category) continue;

            Product::firstOrCreate(
                [
                    'slug' => Str::slug($p['name']),
                    'category_id' => $category->id,
                    'city_id' => null,
                ],
                [
                    'name' => $p['name'],
                    'description' => $p['name'] . ' - DrDrink özel tarifi',
                    'price' => $p['price'],
                    'is_active' => true,
                    'sort_order' => 0,
                ]
            );
        }

        // Kütahya'ya özel birkaç ürün
        if ($kutahya) {
            $kutahyaProducts = [
                ['category' => 'sicak-kahveler', 'name' => 'Kütahya Özel Karışım', 'price' => 65.00],
            ];
            foreach ($kutahyaProducts as $p) {
                $category = $categories->get($p['category']);
                if (!$category) continue;

                Product::firstOrCreate(
                    [
                        'slug' => Str::slug($p['name']),
                        'category_id' => $category->id,
                        'city_id' => $kutahya->id,
                    ],
                    [
                        'name' => $p['name'],
                        'description' => 'Sadece Kütahya\'da - Özel karışım kahvemiz',
                        'price' => $p['price'],
                        'is_active' => true,
                        'sort_order' => 0,
                    ]
                );
            }
        }
    }
}
