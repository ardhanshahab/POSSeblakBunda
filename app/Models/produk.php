<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'nama_produk',
        'kategori_produk',
        'harga',
        'deskripsi',
        'quantity',
    ];

    public function toppings()
    {
        return $this->belongsToMany(Topping::class, 'product_topping');
    }
}
