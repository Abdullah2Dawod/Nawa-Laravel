<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

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

    const STATUS_PENDING   = 'pending';
    const STATUS_PROCESSING    = 'processing';
    const STATUS_SHIPPED = 'shipped';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_REFUNDED = 'refunded';
    const STATUS_PENDING_PAY = 'pending_pay';
    const STATUS_PAID = 'paid';
    const STATUS_FAILED = 'failed';
    public static function statusOptions()
    {
        return [
            self::STATUS_PENDING   => 'pending',
            self::STATUS_PROCESSING   => 'processing',
            self::STATUS_SHIPPED  => 'shipped',
            self::STATUS_COMPLETED  => 'completed',
            self::STATUS_CANCELLED  => 'cancelled',
            self::STATUS_REFUNDED => 'refunded',
        ];
    }
    public static function paymentStatusOptions()
    {
        return [
            self::STATUS_PENDING_PAY   => 'pending_pay',
            self::STATUS_PAID   => 'paid',
            self::STATUS_FAILED   => 'failed',

        ];
    }

    public function scopeFilter(Builder $query, $request)
    {
        $query->when($request->search ?? false , function ($query, $value) {
            $query->where(function ($query) use ($value) {
                $query->where('orders.customer_first_name', 'LIKE', "%{$value}%")
                    ->orWhere('orders.customer_last_name', 'LIKE', "%{$value}%");
            });
        })
            ->when($request->status ?? false, function ($query, $value) {
                $query->where('orders.status', 'LIKE', "$value");
            })
            ->when($request->payment_status ?? false, function ($query, $value) {
                $query->where('orders.payment_status', 'LIKE', "$value");
            });
    }
}
