<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'quantity',
        'total',
        'order_id',
        'toppings',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function produk()
    {
        return $this->belongsTo(produk::class, 'product_id', 'id');
    }

    public function toppings()
    {
        return $this->belongsToMany(Topping::class);
    }
}
