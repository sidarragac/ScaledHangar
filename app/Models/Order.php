<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    // Getters
    public function getUserIdAttribute(): int
    {
        return $this->attributes['user_id'];
    }

    public function getTotalAttribute(): float
    {
        return $this->attributes['total'];
    }

    public function getStatusAttribute(): string
    {
        return $this->attributes['status'];
    }


    // Setters
    public function setUserIdAttribute(int $value): void
    {
        $this->attributes['user_id'] = $value;
    }

    public function setTotalAttribute(float $value): void
    {
        $this->attributes['total'] = $value;
    }

    public function setStatusAttribute(string $value): void
    {
        $this->attributes['status'] = $value;
    }


    // Relationships
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // Formatted accessors
    public function getFormattedTotalAttribute(): string
    {
        return number_format($this->total, 2);
    }

    public function getStatusLabelAttribute(): string
    {
        return ucfirst($this->status);
    }
}