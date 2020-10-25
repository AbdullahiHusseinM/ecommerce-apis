<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    public function index()
    {
        //
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
    public function createOrder(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'order_date' => 'required|date'

        ]);

        $orders = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->select('order_items.*')
            ->get();

        $data = array();

        $data['user_id'] = Auth()->user()->id;
        $data['address'] = $request->address;
        $data['phone'] = $request->phone;
        $data['order_date'] = $request->order_date;


        $order = Order::create($data);

        return response()->json([
            'message' => 'Order made succesfully',
            'data' => $order,
            'user' => array(
                'name' => Auth()->user()->first_name. ' '. Auth()->user()->last_name,
                'email' => Auth()->user()->email
            )
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function viewmyorders(Order $order)
    {
        $myorders = Auth()->user()->order;

        return response()->json([
            'message' => 'My orders retrieved successfully',
            'data' => $myorders
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
