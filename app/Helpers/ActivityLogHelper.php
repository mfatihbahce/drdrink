<?php

namespace App\Helpers;

use Spatie\Activitylog\Models\Activity;

class ActivityLogHelper
{
    /** İşlem türü → Türkçe etiket */
    public static function actionLabel(string $description): string
    {
        return match ($description) {
            'created' => 'Oluşturuldu',
            'updated' => 'Güncellendi',
            'deleted' => 'Silindi',
            default => $description,
        };
    }

    /** Alan adı → Türkçe etiket */
    public static function attributeLabel(string $key): string
    {
        return match ($key) {
            'name' => 'Ad Soyad',
            'email' => 'E-posta',
            'phone' => 'Telefon',
            'password' => 'Şifre',
            'is_active' => 'Aktif',
            'sort_order' => 'Sıra',
            'price' => 'Fiyat',
            'description' => 'Açıklama',
            'category_id' => 'Kategori',
            'city_id' => 'İl',
            default => $key,
        };
    }

    /** Konu tipi → Türkçe etiket */
    public static function subjectLabel(?string $subjectType): string
    {
        if (!$subjectType) return '-';
        return match (class_basename($subjectType)) {
            'User' => 'Kullanıcı',
            'Order' => 'Sipariş',
            'Product' => 'Ürün',
            'Category' => 'Kategori',
            'City' => 'İl',
            'Role' => 'Rol',
            default => class_basename($subjectType),
        };
    }

    /** Properties'ten okunabilir özet oluştur */
    public static function formatProperties(Activity $log): string
    {
        $props = $log->properties->toArray();
        if (empty($props)) return '-';

        $lines = [];
        $attrs = $props['attributes'] ?? [];
        $old = $props['old'] ?? [];

        // Gizlenecek alanlar
        $hidden = ['password', 'remember_token'];

        if ($log->description === 'updated') {
            $keys = array_unique(array_merge(array_keys($attrs), array_keys($old)));
            foreach ($keys as $key) {
                if (in_array($key, $hidden)) continue;
                $oldVal = $old[$key] ?? null;
                $newVal = $attrs[$key] ?? null;
                if ($oldVal === $newVal) continue;
                $label = self::attributeLabel($key);
                if ($oldVal !== null && $newVal !== null) {
                    $lines[] = "{$label}: " . self::formatValue($oldVal) . " → " . self::formatValue($newVal);
                } elseif ($newVal !== null) {
                    $lines[] = "{$label}: " . self::formatValue($newVal) . " (eklendi)";
                } else {
                    $lines[] = "{$label}: " . self::formatValue($oldVal) . " (kaldırıldı)";
                }
            }
        } elseif ($log->description === 'created' && !empty($attrs)) {
            foreach ($attrs as $key => $val) {
                if (in_array($key, $hidden)) continue;
                $label = self::attributeLabel($key);
                $lines[] = "{$label}: " . self::formatValue($val);
            }
        } elseif ($log->description === 'deleted' && !empty($old)) {
            foreach ($old as $key => $val) {
                if (in_array($key, $hidden)) continue;
                $label = self::attributeLabel($key);
                $lines[] = "{$label}: " . self::formatValue($val);
            }
        }

        if (!empty($lines)) return implode("\n", $lines);

        // Fallback: attributes veya old farklı yapıda olabilir
        if (!empty($attrs) && empty($old)) {
            foreach ($attrs as $key => $val) {
                if (in_array($key, $hidden)) continue;
                $lines[] = self::attributeLabel($key) . ": " . self::formatValue($val);
            }
        }

        return !empty($lines) ? implode("\n", $lines) : '-';
    }

    private static function formatValue(mixed $val): string
    {
        if (is_array($val) || is_object($val)) {
            return json_encode($val, JSON_UNESCAPED_UNICODE);
        }
        return (string) $val;
    }

    /** Log kaydından mağaza etiketini döndür (varsa) */
    public static function storeTag(Activity $log): ?string
    {
        $subject = $log->subject;
        if (!$subject) return null;

        if ($subject instanceof \App\Models\Order && $subject->store) {
            return $subject->store->name . ($subject->store->city ? ' (' . $subject->store->city->name . ')' : '');
        }
        if ($subject instanceof \App\Models\User) {
            $store = $subject->stores()->with('city')->first();
            return $store ? $store->name . ($store->city ? ' (' . $store->city->name . ')' : '') : null;
        }

        return null;
    }
}
