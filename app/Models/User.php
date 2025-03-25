<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\WishItem;

/*
* $this->attributes['id'] - int - primary key
* $this->attributes['name'] - string - user name
* $this->attributes['email'] - string - user email
* $this->attributes['email_verified_at'] - datetime - email verification date
* $this->attributes['password'] - string - user password
* $this->attributes['remember_token'] - string - remember me token
* $this->attributes['created_at'] - datetime - user creation date
* $this->attributes['updated_at'] - datetime - user last update date
* $this->wishItems - WishItem[] - the user's wishlist items
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

    public function wishItems()
    {
        return $this->hasMany(WishItem::class);
    }

    public function getWishItems()
    {
        return $this->wishItems;
    }

    
}
