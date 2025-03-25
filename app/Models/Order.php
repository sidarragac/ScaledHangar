<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total',
        'status',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Accessor for formatted total
    public function getFormattedTotalAttribute()
    {
        return number_format($this->total, 2);
    }

    // Accessor for status label
    public function getStatusLabelAttribute()
    {
        return ucfirst($this->status);
    }
}