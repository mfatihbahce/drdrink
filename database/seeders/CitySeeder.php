<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            ['name' => 'Kütahya', 'is_active' => true, 'sort_order' => 1],
            ['name' => 'İstanbul', 'is_active' => true, 'sort_order' => 2],
            ['name' => 'Ankara', 'is_active' => true, 'sort_order' => 3],
            ['name' => 'İzmir', 'is_active' => true, 'sort_order' => 4],
            ['name' => 'Bursa', 'is_active' => true, 'sort_order' => 5],
            ['name' => 'Antalya', 'is_active' => false, 'sort_order' => 6],
            ['name' => 'Eskişehir', 'is_active' => true, 'sort_order' => 7],
        ];

        foreach ($cities as $city) {
            City::firstOrCreate(
                ['slug' => Str::slug($city['name'])],
                [
                    'name' => $city['name'],
                    'is_active' => $city['is_active'],
                    'sort_order' => $city['sort_order'],
                ]
            );
        }
    }
}
