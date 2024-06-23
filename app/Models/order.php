<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $fillable = ['no_meja', 'invoice_number', 'amount', 'status', 'catatan'];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function meja()
    {
        return $this->hasMany(meja::class, 'no_meja', 'no_meja');
    }
    public function fcfs()
    {
        return $this->belongsTo(fcfs::class, 'invoice_number', 'invoice_number');
    }
}
