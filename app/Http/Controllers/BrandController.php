<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all()->pluck('brand_name', 'id');
        
        return response()->json([
            'message' => 'All brands retrieved successfully',
            'brands' => $brands,
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
            'brand_name' => 'required|unique:brands|max:255',
            'brand_logo' => 'required'
            
        ]);

        $data = array();
        $data['brand_name'] = $request->brand_name;
        $image = $request->file('brand_logo');

        if($image) {
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name. '.' .$ext;
            $upload_path = 'public/media/brand/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);

            $data['brand_logo'] = $image_url;
            $brand = Brand::create($data);

            return response()->json([
                'message' => 'Brand added successfully',
                'brand_name' => $brand->brand_name,
                'brand_logo' => $brand->brand_logo,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $brand = Brand::findorFail($id);
        $oldlogo = $brand->brand_logo;
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $image = $request->file('brand_logo');

        if($image) {
            unlink($oldlogo);
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name. '.' .$ext;
            $upload_path = 'public/media/brand/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);

            $data['brand_logo'] = $image_url;
            $brandUpdate = $brand->update($data);

            return response()->json([
                'message' => 'Brand updated successfully',
                'brand_name' => $brand->brand_name,
                'brand_logo' => $brand->brand_logo,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::findorFail($id);
        $image = $brand->brand_logo;

        unlink($image);
        $brand->delete();

        return response()->json([
            'message' => 'Brand deleted successfully'
        ]);
    }
}
