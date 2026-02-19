<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'dashboard',
            'orders.view', 'orders.create', 'orders.update', 'orders.delete',
            'products.view', 'products.create', 'products.update', 'products.delete',
            'categories.view', 'categories.create', 'categories.update', 'categories.delete',
            'cities.view', 'cities.create', 'cities.update', 'cities.delete',
            'users.view', 'users.create', 'users.update', 'users.delete',
            'roles.view', 'roles.create', 'roles.update', 'roles.delete',
            'activity_log.view',
            'settings.view', 'settings.update',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $adminRole = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $adminRole->givePermissionTo(Permission::all());

        $managerRole = Role::firstOrCreate(['name' => 'Yönetici', 'guard_name' => 'web']);
        $managerRole->givePermissionTo([
            'dashboard', 'orders.view', 'orders.update', 'products.view', 'products.update',
            'categories.view', 'cities.view', 'users.view', 'activity_log.view'
        ]);

        $staffRole = Role::firstOrCreate(['name' => 'Personel', 'guard_name' => 'web']);
        $staffRole->givePermissionTo(['dashboard', 'orders.view', 'orders.update', 'products.view']);

        $storeManagerRole = Role::firstOrCreate(['name' => 'Mağaza Yöneticisi', 'guard_name' => 'web']);
        $storeManagerRole->givePermissionTo([
            'dashboard',
            'orders.view', 'orders.update',
            'products.view', 'products.create', 'products.update',
            'categories.view', 'categories.create', 'categories.update',
            'settings.view', 'settings.update',
        ]);

        $cashierRole = Role::firstOrCreate(['name' => 'Kasiyer', 'guard_name' => 'web']);
        $cashierRole->givePermissionTo(['dashboard', 'orders.view', 'orders.update']);
    }
}
