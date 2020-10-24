<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::select('id', 'product_name',  'image_one', 'product_details', 'selling_price', 'discount_price', 'product_color')->get();
        return response()->json([
            'message' => 'Products Retrieved Successfully',

            'data' => array(
                'products' => $products,
            )
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'category_id' => 'required',
            'subcategory_id'=> 'required',
            'brand_id' => 'required',
            'product_name'=> 'required|unique:products',
            'product_code'=> 'required',
            'product_quantity'=> 'required',
            'product_details'=> 'required',
            'product_color'=> 'required',
            'selling_price'=> 'required',
            'discount_price'=> 'required',
            'image_one'=> 'required',
        ]);

        $data = array();

        $data['category_id'] = $request->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_details'] = $request->product_details;
        $data['product_color'] = $request->product_color;
        $data['selling_price'] = $request->selling_price;
        $data['discount_price'] = $request->discount_price;
        

        $image = $request->file('image_one');
       
        
        

        if($image) {
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name. '.' .$ext;
            $upload_path = 'public/media/product/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);

            $data['image_one'] = $image_url;
            $product = Product::create($data);

            return response()->json([
                'message' => 'Product added successfully',
                'product_name' => $product->product_name,
                'category' => $product->category->category_name,
                'subcategory' => $product->subcategory->subcategory_name
            ]);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findorFail($id);
        $oldimage = $product->image_one;
        
        $data = array();
        $data['category_id'] = $request->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_details'] = $request->product_details;
        $data['product_color'] = $request->product_color;
        $data['selling_price'] = $request->selling_price;
        $data['discount_price'] = $request->discount_price;
        $image = $request->file('image_one');

        if($image) {
            unlink($oldimage);
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name. '.' .$ext;
            $upload_path = 'public/media/product/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);

            $data['image_one'] = $image_url;
            $productUpdate = $product->update($data);

            return response()->json([
                'message' => 'Product updated successfully',
                'product_name' => $product->product_name,
                'category' => $product->category->category_name,
                'subcategory' => $product->subcategory->subcategory_name
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findorFail($id);
        $image = $product->image_one;

        unlink($image);

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }
}
