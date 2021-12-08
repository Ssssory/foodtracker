<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRquest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Order::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStoreRquest $request)
    {
        $order = new Order;
        $order->order_id = $request->input('order');
        $order->external_id = $request->input('external', null);
        $order->status = "NEW";
        $order->point()->associate($request->point);
        $order->save();

        return response()->json($order);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOfFail($id);

        return response()->json($order);
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
        return response()->json(self::TIME_LESS_TEXT, Response::HTTP_METHOD_NOT_ALLOWED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(self::TIME_LESS_TEXT, Response::HTTP_METHOD_NOT_ALLOWED);
    }
}
