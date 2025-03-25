<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /*
     * Order ATTRIBUTES
     * $this->attributes['id'] - int - contains the order primary key (id)
     * $this->attributes['status'] - string - contains the status of the order
     * $this->attributes['total'] - float - contains the total price of the order
     * $this->attributes['created_at'] - timestamp - contains the creation date of the order
     * $this->attributes['updated_at'] - timestamp - contains the last update date of the order
     * $this->user - User - contains the associated user
     * $this->orderItems - OrderItem[] - contains the associated order items
    */
    protected $fillable = ['user_id', 'total', 'status'];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getStatus(): string
    {
        return $this->attributes['status'];
    }

    public function setStatus(string $value): void
    {
        $this->attributes['status'] = $value;
    }

    public function getTotal(): float
    {
        return $this->attributes['total'];
    }

    public function setTotal(float $value): void
    {
        $this->attributes['total'] = $value;
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }
}