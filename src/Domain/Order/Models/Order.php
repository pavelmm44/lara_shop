<?php

namespace Domain\Order\Models;

use Domain\Auth\Models\User;
use Domain\Order\Enums\OrderStatuses;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Support\ValueObjects\Price;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'payment_method_id',
        'delivery_type_id',
        'amount',
        'status'
    ];

    protected $casts = [
        'amount' => Price::class
    ];

    protected $attributes = [
        'status' => 'new'
    ];

    public function status(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => OrderStatuses::from($value)->createState($this)
        );
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function deliveryType(): BelongsTo
    {
        return $this->belongsTo(DeliveryType::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function orderCustomer(): HasOne
    {
        return $this->hasOne(OrderCustomer::class);
    }
}
