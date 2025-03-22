<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class Product extends Model
{
    /*
     * PRODUCT ATTRIBUTES
     * $this->attributes['id'] - int - contains the product primary key (id)
     * $this->attributes['name'] - string - contains the product name
     * $this->attributes['description'] - string - contains the product description
     * $this->attributes['price'] - float - contains the product price
     * $this->attributes['brand'] - string - contains the product brand
     * $this->attributes['stockQuantity'] - int - contains the product stock quantity
     * $this->attributes['imageUrl'] - string - contains the product image URL or path
     * $this->attributes['created_at'] - timestamp - contains the creation date of the product
     * $this->attributes['updated_at'] - timestamp - contains the last update date of the product
     * $this->category - Category - contains the associated category
     * $this->orderItems - OrderItem[] - contains the associated order items
     * $this->wishItems - WishItem[] - contains the associated wishlist items
    */
    protected $fillable = ['name', 'description', 'price', 'brand', 'stockQuantity', 'image', 'categoryId'];

    public static function validate(Request $request): void
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'brand' => 'required|string|max:255',
            'stockQuantity' => 'required|integer|min:0',
            'image' => 'required|string|max:255',
            'categoryId' => 'required|integer|exists:categories,id',
        ]);
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function setDescription(string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function getPrice(): float
    {
        return $this->attributes['price'];
    }

    public function setPrice(float $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function getBrand(): string
    {
        return $this->attributes['brand'];
    }

    public function setBrand(string $brand): void
    {
        $this->attributes['brand'] = $brand;
    }

    public function getStockQuantity(): int
    {
        return $this->attributes['stockQuantity'];
    }

    public function setStockQuantity(int $stockQuantity): void
    {
        $this->attributes['stockQuantity'] = $stockQuantity;
    }

    public function getImageUrl(): string
    {
        return $this->attributes['image'];
    }

    public function setImageUrl(string $image): void
    {
        $this->attributes['image'] = $image;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function wishItems(): HasMany
    {
        return $this->hasMany(WishItem::class);
    }

    public function getWishItems(): Collection
    {
        return $this->wishItems;
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }
}
