<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_PREPARING = 'preparing';
    const STATUS_ASSIGNED = 'assigned_to_courier';
    const STATUS_ON_THE_WAY = 'on_the_way';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_CANCELLED = 'cancelled';

    const PAYMENT_PENDING = 'pending';
    const PAYMENT_PAID = 'paid';
    const PAYMENT_FAILED = 'failed';
    const PAYMENT_REFUNDED = 'refunded';

    const TYPE_PACKAGE = 'package';
    const TYPE_QUICK_SALE = 'quick_sale';

    protected $fillable = [
        'user_id', 'city_id', 'store_id', 'order_number', 'status', 'address', 'phone',
        'customer_name', 'notes', 'subtotal', 'delivery_fee', 'discount_amount', 'discount_type', 'total',
        'payment_status', 'payment_method', 'order_type'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'delivery_fee' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function statusLogs(): HasMany
    {
        return $this->hasMany(OrderStatusLog::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public static function generateOrderNumber(): string
    {
        $prefix = 'DD';
        $date = now()->format('ymd');
        $random = strtoupper(substr(uniqid(), -4));
        $sequence = str_pad((string) (self::whereDate('created_at', today())->count() + 1), 3, '0', STR_PAD_LEFT);
        return "{$prefix}{$date}{$random}{$sequence}";
    }

    public static function getStatusLabels(): array
    {
        return [
            self::STATUS_PENDING => 'Beklemede',
            self::STATUS_CONFIRMED => 'Onaylandı',
            self::STATUS_PREPARING => 'Hazırlanıyor',
            self::STATUS_ASSIGNED => 'Kurye Atandı',
            self::STATUS_ON_THE_WAY => 'Yolda',
            self::STATUS_DELIVERED => 'Teslim Edildi',
            self::STATUS_CANCELLED => 'İptal Edildi',
        ];
    }

    public static function getPaymentStatusLabels(): array
    {
        return [
            self::PAYMENT_PENDING => 'Beklemede',
            self::PAYMENT_PAID => 'Ödeme Alındı',
            self::PAYMENT_FAILED => 'Ödeme Başarısız',
            self::PAYMENT_REFUNDED => 'İade Edildi',
        ];
    }
}
