<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /*
    * $this-> attributes['id'] - int - primary key
    * $this-> attributes['created_at'] - datetime
    * $this-> attributes['updated_at'] - datetime
    */
    protected $fillable = [];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function wishItems()
    {
        return $this->hasMany(WishItem::class);
    }

    public function getWishItems()
    {
        return $this->wishItems;
    }
}
