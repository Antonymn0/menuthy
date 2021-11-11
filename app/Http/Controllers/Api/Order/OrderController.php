<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Events\Order\orderCreated;
use App\Events\Order\orderUpdated;
use App\Events\Order\orderDestroyed;
use App\Http\Requests\Order\ValidateOrder;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success'=> true,
            'message' => 'A list of orders',
            'data'=>$orders], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidateOrder  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateOrder $request)
    {
        $data = $request->validated();        
        $order = Order::create($data);
        event(new orderCreated($order));
        return response()->json([
            'success'=> true,
            'message'=> 'Order created successfuly',
            'data'=> true,
            ],  201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order= Order::findOrFail($id);
        return response()->json([
            'success'=> true,
            'message'=> 'Á single order retrieved successfully', 
            'data'=>$order], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidateOrder  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateOrder $request, $id)
    {
        $data = $request->validated();
        $order = Order::findOrFail($id)->update($data);
        event(new orderUpdated($order));
        return response()->json([
            'success'=> true, 
            'message'=>'Order updated successfuly', 
            'data'=>$order],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id)->delete();
        event(new orderDestroyed($order));
        return response()->json([
            'success'=> true, 
            'message'=> 'Order deleted successfuly', 
            'data'=>$order], 200);
    }

    /**
     * Restore the specified resource back into storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore( $id)
    {
        $order = Order::onlyTrashed()->findOrFail($id)->restore(); 
        return response()->json([
            'success'=> true, 
            'message'=>'Order restored successfully', 
            'data'=>$order],  200);
    }

     /**
     * Parmanently remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function parmanentlyDelete($id)
    {
        $order = Order::onlyTrashed()->findOrFail($id)->forceDelete();
        event(new orderDestroyed($order)); 
        return response()->json([
            'success' => true,
            'message' => 'Order parmanently deleted!',
            'data' => $order
        ], 200);
    }

}
