<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'gender' , 'birthday' , 'street' , 'city' , 'province',
        'postal_code', 'country_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    const STATUS_MALE   = 'male';
    const STATUS_FEMALE    = 'female';

    public static function genderOptions()
    {
        return [
            self::STATUS_MALE   => 'male',
            self::STATUS_FEMALE   => 'female',
        ];
    }
}
