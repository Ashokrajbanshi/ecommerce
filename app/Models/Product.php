<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $casts = [
        "image" => "array"
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }
    // // Add this method to the Product model
    // public function wishlistedByUsers()
    // {
    //     return $this->belongsToMany(User::class, 'wishlists', 'product_id', 'user_id');
    // }


}
