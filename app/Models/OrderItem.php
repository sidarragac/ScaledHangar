<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    // Getters
    public function getOrderIdAttribute(): int
    {
        return $this->attributes['order_id'];
    }

    public function getProductIdAttribute(): int
    {
        return $this->attributes['product_id'];
    }

    public function getQuantityAttribute(): int
    {
        return $this->attributes['quantity'];
    }

    public function getPriceAttribute(): float
    {
        return $this->attributes['price'];
    }

    // Setters
    public function setOrderIdAttribute(int $value): void
    {
        $this->attributes['order_id'] = $value;
    }

    public function setProductIdAttribute(int $value): void
    {
        $this->attributes['product_id'] = $value;
    }

    public function setQuantityAttribute(int $value): void
    {
        $this->attributes['quantity'] = $value;
    }

    public function setPriceAttribute(float $value): void
    {
        $this->attributes['price'] = $value;
    }

    // Relationships
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // Formatted accessors
    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 2);
    }

    public function getTotalAttribute(): float
    {
        return $this->quantity * $this->price;
    }

    public function getFormattedTotalAttribute(): string
    {
        return number_format($this->total, 2);
    }
}