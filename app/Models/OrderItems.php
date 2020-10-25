<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class OrderItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'order_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }


}
