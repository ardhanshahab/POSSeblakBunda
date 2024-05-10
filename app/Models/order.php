<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $fillable = ['no_meja', 'invoice_number', 'amount'];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
