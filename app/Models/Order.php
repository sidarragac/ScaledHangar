<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Order extends Model
{
    use HasFactory;

    /*
    * -Order- ATTRIBUTES
    * $this->attributes['id'] - int - contains the order primary key
    * $this->attributes['user_id'] - int - contains the associated user id
    * $this->attributes['total'] - float - contains the order total
    * $this->attributes['status'] - string - contains the order status
    * $this->attributes['created_at'] - timestamp - contains the order creation timestamp
    * $this->attributes['updated_at'] - timestamp - contains the order last update timestamp
    */
    
    protected $fillable = ['user_id', 'total', 'status'];
    
    public static function validate(Request $request): void
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total' => 'required|numeric|min:0',
            'status' => 'required|string|max:255'
        ]);
    }

    // Relationships
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // Getters
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getTotal(): float
    {
        return $this->attributes['total'];
    }

    // ... otros getters y setters según necesidades
}