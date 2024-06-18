<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fcfs extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'order_time',
        'order_completed_time',
        'customer_left_time'
    ];

    public function invoice()
    {
        return $this->hasMany(order::class, 'invoice_number', 'invoice_number');
    }
    /**
     * Set the order time to the current timestamp.
     */
    public function setOrderTime()
    {
        $this->order_time = now();
        $this->save();
    }

    /**
     * Set the order completed time to the current timestamp.
     */
    public function setOrderCompletedTime()
    {
        $this->order_completed_time = now();
        $this->save();
    }

    /**
     * Set the customer left time to the current timestamp.
     */
    public function setCustomerLeftTime()
    {
        $this->customer_left_time = now();
        $this->save();
    }
}

