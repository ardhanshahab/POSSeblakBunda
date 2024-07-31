<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'tipe'];

    public function products()
    {
        return $this->belongsToMany(Produk::class, 'product_topping');
    }

    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class);
    }
}
