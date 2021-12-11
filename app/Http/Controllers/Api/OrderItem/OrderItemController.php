<?php

namespace App\Http\Controllers\Api\OrderItem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\OrderItem\orderItemCreated;
use App\Events\OrderItem\orderItemUpdated;
use App\Events\OrderItem\orderItemDestroyed;
use App\Http\Requests\OrderItem\ValidateOrderItem;
use App\Models\OrderItem;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderItem = OrderItem::paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success'=> true,
            'message' => 'A list of order Items',
            'data'=>$orderItem], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidateOrderItem  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateOrderItem $request)
    {
        $data = $request->validated();  
      
        $orderItem = OrderItem::create($data);
        event(new orderItemCreated($orderItem));
        return response()->json([
            'success'=> true,
            'message'=> 'Order Item created successfuly',
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
        $orderItem= OrderItem::WHERE('id', $id)->first();
        return response()->json([
            'success' => true,
           'message' => 'order Item fetched',
           'data' => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\Validateorder$orderItemItem  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateOrderItem $request, $id)
    {
        $order= OrderItem::findOrFail($id);
        return response()->json([
            'success'=> true,
            'message'=> 'Á single order retrieved successfully', 
            'data'=>$order], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orderItem = OrderItem::findOrFail($id)->delete();
        event(new orderItemDestroyed($orderItem));
        return response()->json([
            'success'=> true, 
            'message'=> 'orderItem deleted successfuly', 
            'data'=>$orderItem], 200);
    }
}
