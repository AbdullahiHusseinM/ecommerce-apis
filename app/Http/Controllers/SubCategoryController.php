<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Subcategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = DB::table('categories')->get();
        $subcategory = DB::table('subcategories')
                    ->join('categories', 'subcategories.category_id', 'categories.id')
                    ->select('subcategories.subcategory_name','categories.category_name')
                    ->get();

                    return response([
                        'subcategory' => $subcategory
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
            'category_id' =>'required',
            'subcategory_name' => 'required|unique:subcategories'
        ]);

        $data = array();

        $data['category_id'] = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;

        $subcategory = Subcategory::create($data);

        return response()->json([
            'message' => 'SubCategory created successfully',

            'data' => array(
            'subcategory_id' => $subcategory->id,
            'category_name' => $subcategory->category->category_name,
            'subcategory_name' => $subcategory->subcategory_name,
            ),
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subcategory = Subcategory::findorFail($id);
        $category = DB::table('categories')->get();

        $data = array();
        $data['category_id'] = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;

        $subcategory->update($data);


        return response()->json([

            'message' => 'Category updated successfully',
            'category_name' => $subcategory->category->category_name,
            'subcategory_name' => $subcategory->subcategory_name,
            'category_id' => $subcategory->id
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = Subcategory::findorFail($id);
        $subcategory->delete();

        return response([
            'message' => 'Subcategory deleted successfully',
        ]);
    }
}
