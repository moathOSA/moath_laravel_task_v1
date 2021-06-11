<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function setQuantityAttribute($value)
    {
        $this->attributes['quantity'] = $value ?? 1;
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value ?? 1;
    }


    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'description',
        'quantity',
        'price',
        'image'
    ];

public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
