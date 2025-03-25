<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/*
* $this->attributes['id'] - int - primary key
* $this->attributes['name'] - string - user name
* $this->attributes['email'] - string - user email
* $this->attributes['email_verified_at'] - datetime - email verification date
* $this->attributes['password'] - string - user password
* $this->attributes['remember_token'] - string - remember me token
* $this->attributes['is_admin'] - bool - user admin status
* $this->attributes['created_at'] - datetime - user creation date
* $this->attributes['updated_at'] - datetime - user last update date
* $this->wishItems - WishItem[] - the user's wishlist items
* $this->Orders - Order[] - the user's orders
*/

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
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

    public function getEmail(): string
    {
        return $this->attributes['email'];
    }

    public function setEmail(string $email): void
    {
        $this->attributes['email'] = $email;
    }

    public function getEmailVerifiedAt(): string
    {
        return $this->attributes['email_verified_at'];
    }

    public function setEmailVerifiedAt(string $email_verified_at): void
    {
        $this->attributes['email_verified_at'] = $email_verified_at;
    }

    public function getPassword(): string
    {
        return $this->attributes['password'];
    }

    public function setPassword(string $password): void
    {
        $this->attributes['password'] = $password;
    }

    public function getIsAdmin(): bool
    {
        return $this->attributes['is_admin'];
    }

    public function setIsAdmin(bool $is_admin): void
    {
        $this->attributes['is_admin'] = $is_admin;
    }

    public function getRememberToken(): ?string
    {
        return $this->attributes['remember_token'];
    }

    public function setRememberToken($remember_token): void
    {
        $this->attributes['remember_token'] = $remember_token;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function wishItems(): HasMany
    {
        return $this->hasMany(WishItem::class);
    }

    public function getWishItems(): Collection
    {
        return $this->wishItems;
    }

    public function Orders(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getOrders(): Collection
    {
        return $this->Orders;
    }
}
