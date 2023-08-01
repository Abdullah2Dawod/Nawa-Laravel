<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'image'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function scopeFilter(Builder $query, $request)
    {
        $query->when($request->search ?? false , function ($query, $value) {
            $query->where('name', 'LIKE', "%{$value}%");
        });
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return Storage::disk('public')->url($this->image);
        }
        return 'https://placehold.co/600x400/orange/white?font=lato&text=NO Image';
    }

    public function specificCategories()
    {
        return $this->hasMany(Product::class)->where('category_type', 'Mixers');
    }
}
