<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class makanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_makanan',
        'keterangan',
        'harga',
        'stok',
        'foto',
        'status',
    ];
}
