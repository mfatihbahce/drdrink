<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAddress extends Model
{
    protected $fillable = [
        'user_id',
        'city_id',
        'title',
        'address',
        'district',
        'neighborhood',
        'street',
        'avenue',
        'building',
        'apartment',
        'address_instructions',
        'phone',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Kurye için tam adres - tüm parçalardan oluşturulur.
     */
    public function getFullAddressAttribute(): string
    {
        $base = $this->address;
        if (!$base) {
            $parts = array_filter([
                $this->city?->name,
                $this->district,
                $this->neighborhood,
                trim(($this->street ?? '') . ' ' . ($this->avenue ?? '')),
                $this->building ? 'No: ' . $this->building : null,
                $this->apartment ? 'Daire: ' . $this->apartment : null,
            ]);
            $base = implode(', ', $parts) ?: '';
        }
        if ($this->address_instructions) {
            $base .= ' — Adres tarifi: ' . $this->address_instructions;
        }
        return $base;
    }
}
