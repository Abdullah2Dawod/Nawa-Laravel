<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class Cart extends Pivot
{
    use HasFactory;
    use HasUuids;

    protected $table = 'carts';
    protected $fillable = [
        'cookie_id', 'user_id', 'product_id', 'quantity'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    protected static function booted()
    {
        static::addGlobalScope('cart_auth', function (Builder $query) {
            $cookie_id = request()->cookie('cart_id');
            $query->where('user_id', '=', Auth::id())
                ->where('cookie_id', '=', $cookie_id);
        });
    }
}
