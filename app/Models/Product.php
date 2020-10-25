<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Order;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'brand_id',
        'product_name',
        'product_code',
        'product_quantity',
        'product_details',
        'product_color',
        'selling_price',
        'discount_price',
        'image_one',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);

    }


    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function order()
    {
        $this->belongsTo(Order::class);
    }

}
