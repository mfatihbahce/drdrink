<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Seeder;

class UserAddressSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::find(3);
        if (!$user) {
            return;
        }

        $istanbul = City::where('name', 'İstanbul')->first();
        $kutahya = City::where('name', 'Kütahya')->first();
        $fallback = City::active()->first();
        if (!$fallback) {
            return;
        }

        $addresses = [
            [
                'city' => $istanbul ?? $fallback,
                'title' => 'Ev',
                'district' => 'Kadıköy',
                'neighborhood' => 'Caferağa Mah.',
                'street' => 'Moda Cad.',
                'avenue' => null,
                'building' => '15',
                'apartment' => '4',
                'address_instructions' => 'Apartmanın 3. katı, kapıyı çalın.',
                'is_default' => true,
            ],
            [
                'city' => $kutahya ?? $fallback,
                'title' => 'İş',
                'district' => 'Merkez',
                'neighborhood' => 'Cumhuriyet Mah.',
                'street' => 'Atatürk Bulvarı',
                'avenue' => null,
                'building' => '42',
                'apartment' => '7',
                'address_instructions' => 'Site girişinde bekleyin, zil çalışmıyor.',
                'is_default' => false,
            ],
        ];

        foreach ($addresses as $data) {
            $city = $data['city'];
            unset($data['city']);
            $addressStr = implode(', ', array_filter([
                $city->name,
                $data['district'],
                $data['neighborhood'],
                trim(($data['street'] ?? '') . ' ' . ($data['avenue'] ?? '')),
                'No: ' . $data['building'],
                $data['apartment'] ? 'Daire: ' . $data['apartment'] : null,
            ]));

            UserAddress::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'title' => $data['title'],
                ],
                [
                    'city_id' => $city->id,
                    'district' => $data['district'],
                    'neighborhood' => $data['neighborhood'],
                    'street' => $data['street'],
                    'avenue' => $data['avenue'],
                    'building' => $data['building'],
                    'apartment' => $data['apartment'],
                    'address' => $addressStr,
                    'address_instructions' => $data['address_instructions'],
                    'is_default' => $data['is_default'],
                ]
            );
        }
    }
}
