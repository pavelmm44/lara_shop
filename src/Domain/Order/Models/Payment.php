<?php

namespace Domain\Order\Models;

use Domain\Order\States\Payment\PaymentState;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasUuids;

    protected $fillable = [
        'payment_id',
        'payment_gateway',
        'meta'
    ];

    protected $casts = [
        'meta' => 'collection',
        'state' => PaymentState::class
    ];

    public function uniqueIds(): array
    {
        return ['payment_id'];
    }
}
