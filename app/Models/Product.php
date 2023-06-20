<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    const STATUS_ACTIVE   = 'active';
    const STATUS_DRAFT    = 'draft';
    const STATUS_ARCHIVED = 'archived';

    protected $fillable = [
        'name' , 'slug' , 'category_id' , 'description' , 'short_description' , 'price' ,
        'compare_price' , 'status' , 'image'
    ];

    public static function statusOptions()
    {
        return [
            self::STATUS_ACTIVE    => 'Active',
            self::STATUS_DRAFT     => 'Draft',
            self::STATUS_ARCHIVED  => 'Archived',
        ];
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return Storage::disk('public')->url($this->image);
        }
        return 
    }
}
