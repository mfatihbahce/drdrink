<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;

class StoreManagerSeeder extends Seeder
{
    public function run(): void
    {
        $store = Store::first();
        if (!$store) {
            return;
        }

        $user = User::firstOrCreate(
            ['email' => 'magaza@drdrink.com'],
            [
                'name' => 'Mağaza Yöneticisi',
                'password' => bcrypt('12345678'),
                'phone' => '05321112233',
            ]
        );

        $user->assignRole('Mağaza Yöneticisi');

        if (!$user->stores()->where('store_id', $store->id)->exists()) {
            $user->stores()->attach($store->id, ['role' => 'manager']);
        }
    }
}
