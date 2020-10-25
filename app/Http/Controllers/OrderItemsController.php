<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use Illuminate\Http\Request;

class OrderItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewallitemsordered()
    {
        $orderItems = OrderItems::all();

        return response()->json([
            'message' => 'all order items retrieved successfully',
            'data' => $orderItems
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
    public function add_items_to_orders(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
            'order_id' => 'required'
        ]);

        $data = array();
        $data['product_id'] = $request->product_id;
        $data['quantity'] = $request->quantity;
        $data['order_id'] = $request->order_id;

        $order_items = OrderItems::create($data);

        return response()->json([
            'message' => 'Items added successfully',
            'data' => $order_items
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderItems  $orderItems
     * @return \Illuminate\Http\Response
     */
    public function show(OrderItems $orderItems)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderItems  $orderItems
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderItems $orderItems)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderItems  $orderItems
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderItems $orderItems)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderItems  $orderItems
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderItems $orderItems)
    {
        //
    }
}
