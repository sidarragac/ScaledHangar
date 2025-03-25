<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderItem extends Model
{
    /*
     * Order ATTRIBUTES
     * $this->attributes['id'] - int - contains the order primary key (id)
     * $this->attributes['order_id'] - int - contains the order id
     * $this->attributes['product_id'] - int - contains the product id
     * $this->attributes['created_at'] - timestamp - contains the creation date of the order item
     * $this->attributes['updated_at'] - timestamp - contains the last update date of the order item
     * $this->user - User - contains the associated user
     * $this->order - Order - contains the associated order
    */

    protected $fillable = ['order_id', 'product_id'];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getOrderId(): int
    {
        return $this->attributes['order_id'];
    }

    public function setOrderId(int $id): void
    {
        $this->attributes['order_id'] = $id;
    }

    public function getProductId(): int
    {
        return $this->attributes['product_id'];
    }

    public function setProductId(int $id): void
    {
        $this->attributes['product_id'] = $id;
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function getOrder(): Collection
    {
        return $this->order;
    }

    public function product(): HasOne
    {
        return $this->hasOne(Product::class);
    }

    public function getProduct(): Collection
    {
        return $this->product;
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
