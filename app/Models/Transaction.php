<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'menu_name',
        'qty',
        'total',
        'employee_name',
    ];

    public function scopeSearch($query)
    {
        if (request('search')) {
            return $query->where('customer_name', 'like', '%' . request('search') . '%')
                        ->orWhere('menu_name', 'like', '%' . request('search') . '%')
                        ->orWhere('qty', 'like', '%' . request('search') . '%')
                        ->orWhere('total', 'like', '%' . request('search') . '%')
                        ->orWhere('employee_name', 'like', '%' . request('search') . '%');
        }
    }
}
