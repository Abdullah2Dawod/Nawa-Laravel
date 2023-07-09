<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'customer_first_name', 'customer_last_name', 'customer_email', 'customer_phone',
        'customer_address', 'customer_city', 'customer_postal_code', 'customer_province', 'customer_country_code',
        'status', 'payment_status','currency', 'total'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class , 'order_lines')
        ->withPivot(['quantity', 'price', 'product_name'])
        ->using(OrderLine::class);
    }

    public function line() {
        return $this->hasMany(OrderLine::class);
    }
}
