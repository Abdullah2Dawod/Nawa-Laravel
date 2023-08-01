<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id' , 'product_id' , 'name' , 'email' , 'rating' , 'subject', 'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // const STATUS_STAR1 = 'star1';
    // const STATUS_STAR2 = 'star2';
    // const STATUS_STAR3 = 'star3';
    // const STATUS_STAR4 = 'star4';
    // const STATUS_STAR5 = 'star5';
    // public static function ratingOptions()
    // {
    //     return [
    //         self::STATUS_STAR1  => 'star1',
    //         self::STATUS_STAR2  => 'star2',
    //         self::STATUS_STAR3  => 'star3',
    //         self::STATUS_STAR4  => 'star4',
    //         self::STATUS_STAR5  => 'star5',
    //     ];
    // }
}
