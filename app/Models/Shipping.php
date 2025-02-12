<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'status', 'tracking_number', 'estimated_delivery_date'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
