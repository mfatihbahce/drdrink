<?php

namespace App\Helpers;

class PermissionLabels
{
    /** Yetki adı → Admin için okunabilir Türkçe etiket */
    public static function getLabels(): array
    {
        return [
            'dashboard' => 'Dashboard',
            'orders.view' => 'Siparişleri Görüntüle',
            'orders.create' => 'Sipariş Oluştur',
            'orders.update' => 'Sipariş Güncelle',
            'orders.delete' => 'Sipariş Sil',
            'products.view' => 'Ürünleri Görüntüle',
            'products.create' => 'Ürün Oluştur',
            'products.update' => 'Ürün Güncelle',
            'products.delete' => 'Ürün Sil',
            'categories.view' => 'Kategorileri Görüntüle',
            'categories.create' => 'Kategori Oluştur',
            'categories.update' => 'Kategori Güncelle',
            'categories.delete' => 'Kategori Sil',
            'cities.view' => 'İlleri Görüntüle',
            'cities.create' => 'İl Oluştur',
            'cities.update' => 'İl Güncelle',
            'cities.delete' => 'İl Sil',
            'users.view' => 'Kullanıcıları Görüntüle',
            'users.create' => 'Kullanıcı Oluştur',
            'users.update' => 'Kullanıcı Güncelle',
            'users.delete' => 'Kullanıcı Sil',
            'roles.view' => 'Rolleri Görüntüle',
            'roles.create' => 'Rol Oluştur',
            'roles.update' => 'Rol Güncelle',
            'roles.delete' => 'Rol Sil',
            'activity_log.view' => 'İşlem Geçmişini Görüntüle',
            'settings.view' => 'Ayarları Görüntüle',
            'settings.update' => 'Ayarları Güncelle',
        ];
    }

    /** Grup adı → Admin için okunabilir Türkçe başlık */
    public static function getGroupLabels(): array
    {
        return [
            'dashboard' => 'Dashboard',
            'orders' => 'Siparişler',
            'products' => 'Ürünler',
            'categories' => 'Kategoriler',
            'cities' => 'İller',
            'users' => 'Kullanıcılar',
            'roles' => 'Roller',
            'activity_log' => 'İşlem Geçmişi',
            'settings' => 'Ayarlar',
            'other' => 'Diğer',
        ];
    }

    public static function label(string $permissionName): string
    {
        return self::getLabels()[$permissionName] ?? $permissionName;
    }

    public static function groupLabel(string $groupName): string
    {
        return self::getGroupLabels()[$groupName] ?? ucfirst($groupName);
    }
}
