<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishItem extends Model
{
    /*
    * $this-> attributes['id'] - int - primary key
    * $this-> attributes['user_id'] - int - foreign key
    * $this-> attributes['product_id'] - int - foreign key
    * $this-> attributes['created_at'] - datetime
    * $this-> attributes['updated_at'] - datetime
    */

    protected $fillable = ['user_id', 'product_id'];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function setUserId(int $user_id): void
    {
        $this->attributes['user_id'] = $user_id;
    }

    public function getProductId(): int
    {
        return $this->attributes['product_id'];
    }

    public function setProductId(int $product_id): void
    {
        $this->attributes['product_id'] = $product_id;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
