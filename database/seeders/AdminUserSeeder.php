<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@drdrink.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password123'),
                'phone' => '05321234567',
            ]
        );
        $admin->assignRole('Super Admin');

        $manager = User::firstOrCreate(
            ['email' => 'yonetici@drdrink.com'],
            [
                'name' => 'Yönetici',
                'password' => bcrypt('password123'),
                'phone' => '05329876543',
            ]
        );
        $manager->assignRole('Yönetici');
    }
}
