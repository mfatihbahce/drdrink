<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Sıcak Kahveler', 'description' => 'Taze çekirdek kahvelerimizden hazırlanan sıcak içecekler', 'sort_order' => 1],
            ['name' => 'Soğuk Kahveler', 'description' => 'Yaz aylarının vazgeçilmezi soğuk kahve çeşitleri', 'sort_order' => 2],
            ['name' => 'Çaylar', 'description' => 'Özel demleme çay çeşitlerimiz', 'sort_order' => 3],
            ['name' => 'İçecekler', 'description' => 'Taze meyve suları ve diğer içecekler', 'sort_order' => 4],
            ['name' => 'Atıştırmalıklar', 'description' => 'Kahvenizin yanına lezzetli atıştırmalıklar', 'sort_order' => 5],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['slug' => Str::slug($cat['name'])],
                [
                    'name' => $cat['name'],
                    'description' => $cat['description'],
                    'is_active' => true,
                    'sort_order' => $cat['sort_order'],
                ]
            );
        }
    }
}
