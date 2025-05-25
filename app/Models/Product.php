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
     * $this->attributes['stock'] - int - contains the product stock quantity
     * $this->attributes['sold'] - int - contains the amount of sold products
     * $this->attributes['imagePath'] - string - contains the product image URL or path
     * $this->attributes['created_at'] - timestamp - contains the creation date of the product
     * $this->attributes['updated_at'] - timestamp - contains the last update date of the product
     * $this->category - Category - contains the associated category
     * $this->orderItems - OrderItem[] - contains the associated order items
     * $this->wishItems - WishItem[] - contains the associated wishlist items
    */
    protected $fillable = ['name', 'description', 'price', 'brand', 'stock', 'sold', 'imagePath', 'category_id'];

    public static function validate(Request $request): void
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric|min:0',
            'brand' => 'sometimes|required|string|max:255',
            'stock' => 'sometimes|required|integer|min:0',
            'imagePath' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'sometimes|required|integer|exists:categories,id',
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

    public function getStock(): int
    {
        return $this->attributes['stock'];
    }

    public function setStock(int $stock): void
    {
        $this->attributes['stock'] = $stock;
    }

    public function getSold(): int
    {
        return $this->attributes['sold'];
    }

    public function setSold(int $sold): void
    {
        $this->attributes['sold'] = $sold;
    }

    public function getImagePath(): string
    {
        return 'storage/' . $this->attributes['imagePath'];
    }

    public function setImagePath(string $image): void
    {
        $this->attributes['imagePath'] = $image;
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

    public static function filterProducts(Request $request): Collection
    {
        $query = Product::query();

        if ($request->filled('sort_sold')) {
            $query->orderBy('sold', $request->input('sort_sold') === 'desc' ? 'desc' : 'asc');
        }

        if ($request->filled('sort_price')) {
            $query->orderBy('price', $request->input('sort_price') === 'desc' ? 'desc' : 'asc');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('brands')) {
            $brands = is_array($request->input('brands')) ? $request->input('brands') : explode(',', $request->input('brands'));
            $query->whereIn('brand', $brands);
        }

        return $query->get();
    }

    public static function relatedProducts(string $id): Collection
    {
        $product = Product::find($id);
        $brand = $product->getBrand();
        $relatedProducts = Product::where('brand', $brand)
            ->where('id', '!=', $id)
            ->take(4)
            ->get();

        return $relatedProducts;
    }
}
