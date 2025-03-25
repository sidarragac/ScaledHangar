<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Accessor for formatted price
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2);
    }

    // Accessor for total price (quantity * price)
    public function getTotalAttribute()
    {
        return $this->quantity * $this->price;
    }

    // Formatted total
    public function getFormattedTotalAttribute()
    {
        return number_format($this->total, 2);
    }
}