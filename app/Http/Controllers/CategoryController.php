<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:sanctum');
    // }
    public function index()
    {
        $categories = Category::select('category_name', 'id')->get();
        return response()->json([
            'message' => 'Category Created Successfully',
            'data' => $categories,
        ], 200);
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
            'category_name' => 'required|unique:categories',
        ]);

        $data = $request->all();
        $category = Category::create($data);
        

        if($data)
        {
            return response()->json([
                'message' => 'Category created successfully',
                'data' => array(
                    'category_name' => $category->category_name,
                    
                    'category_id' => $category->id
                ),
                
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findorFail($id);
        return response()->json([
            'id' => $category->id,
            'name' => $category->category_name,
        ], 200);
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
        $category = Category::findorFail($id);

        $validatedData = $request->validate([
            'category_name' => 'required',
        ]);

        $data = $request->all();
        $category->update($data);

        return response()->json([
            'message' => 'Category updated successfully',
            'category_name' => $category->category_name,
            'category_id' => $category->id
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
        $category = Category::findorFail($id);
        
        if($category->fails())
        {
            return response()->json([
            
                'message' => 'Category not found'
            ]);
        }
        $category->delete();

        return response()->json([
            
            'message' => 'Category deleted successsfully'
        ]);
    }
}
