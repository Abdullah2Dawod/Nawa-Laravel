<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use NumberFormatter;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_ACTIVE   = 'active';
    const STATUS_DRAFT    = 'draft';
    const STATUS_ARCHIVED = 'archived';

    protected $fillable = [
        'name', 'slug', 'category_id', 'description', 'short_description', 'price',
        'compare_price', 'status', 'image', 'user_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault([
            'name' => 'Non-Category',
        ]);
    }

    public function cart()
    {
        return $this->belongsToMany(User::class,
        'carts' , 'product_id' , 'user_id', 'id ' , 'id')
        ->withPivot(['quantity'])
        ->withTimestamps()
        ->using(Cart::class);
    }

    // protected static function booted()
    // {
    //     static::addGlobalScope('owner' , function(Builder $query)
    //     {
    //         $query->where('user_id' , '=' , Auth::id());
    //     });
    // }

    public function scopeActive(Builder $query)
    {
        $query->where('status' , '=' , 'active');
    }

    public function scopeStatus(Builder $query , $status)
    {
        $query->where('status' , '=' , $status);
    }

    public function scopeFilter(Builder $query , $request)
    {
        $query->when($request->search,function($query , $value) {
            $query->where(function($query) use($value){
                $query->where('products.name' , 'LIKE' , "%{$value}%")
                ->orWhere('products.description' , 'LIKE' , "%{$value}%");
            });
        })
        ->when($request->status,function($query , $value) {
            $query->where('products.status' , 'LIKE' , "$value");
        })
        ->when($request->category_id,function($query , $value) {
            $query->where('products.category_id' , '=' , "$value");
        })
        ->when($request->price_min,function($query , $value) {
            $query->where('products.price' , '<=' , "$value");
        })
        ->when($request->price_max,function($query , $value) {
            $query->where('products.price' , '>=' , "$value");
        });

    }

    public static function statusOptions()
    {
        return [
            self::STATUS_ACTIVE    => 'Active',
            self::STATUS_DRAFT     => 'Draft',
            self::STATUS_ARCHIVED  => 'Archived',
        ];
    }

    // Attribute Accessors : image_url | $product->image_url
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return Storage::disk('public')->url($this->image);
        }
        return 'https://placehold.co/60x60?text=No+Image';
    }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function getPriceFormattedAttribute($value)
    {
        $price = new NumberFormatter('en', NumberFormatter::CURRENCY); //ar.العربية
        return $price->formatCurrency($this->price, 'ILS');  // ILS -
    }
    public function getComparePriceFormattedAttribute($value)
    {
        $compare_price = new NumberFormatter('en', NumberFormatter::CURRENCY); //ar.العربية
        return $compare_price->formatCurrency($this->compare_price, 'ILS');  // ILS -
    }
}
