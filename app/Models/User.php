<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        // 'type',
        // 'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class)->withDefault([
            'first_name' => 'No Name'
        ]);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function cart()
    {
        return $this->belongsToMany(Product::class,
        'carts' , 'user_id' , 'product_id', 'id ' , 'id')
        ->withPivot(['quantity'])
        ->withTimestamps()
        ->using(Cart::class);
    }

    const STATUS_ACTIVE   = 'active';
    const STATUS_INACTIVE    = 'inactive';
    const STATUS_BLOCKED    = 'blocked';
    const STATUS_SUPER_ADMIN = 'super-admin';
    const STATUS_ADMIN = 'admin';
    const STATUS_USER = 'user';

    public static function statusOptions()
    {
        return [
            self::STATUS_ACTIVE    => 'active',
            self::STATUS_INACTIVE     => 'inactive',
            self::STATUS_BLOCKED  => 'blocked',
        ];
    }
    public static function typeOptions()
    {
        return [
            self::STATUS_SUPER_ADMIN    => 'super-admin',
            self::STATUS_ADMIN     => 'admin',
            self::STATUS_USER  => 'user',
        ];
    }
}
