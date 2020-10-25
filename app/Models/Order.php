<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderItems;
class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'phone' ,'address', 'order_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orderitem()
    {
        return $this->hasMany(OrderItems::class);
    }

}
