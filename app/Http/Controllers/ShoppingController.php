<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Models\Product;

class ShoppingController extends Controller
{
    public function add_to_cart(Request $request, $id)
    {
        $prodShop = Product::find($id);

        Cart::add([
            'id' => $prodShop->product_id,
            'name' => $prodShop->product_name,
            'quantity' => $request->product_quantity,
            'price' => $prodShop->product_price,
            'weight' => 0
        ]);

        dd(Cart::content());
    }
}
