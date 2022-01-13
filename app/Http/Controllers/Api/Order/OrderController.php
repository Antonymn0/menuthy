<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Events\Order\orderCreated;
use App\Events\Order\orderUpdated;
use App\Events\Order\orderDestroyed;
use App\Http\Requests\Order\ValidateOrder;
use Carbon\Carbon;

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
        
        // save data for order items after order is created
        $orderItems = json_decode($request->order_items);
        $newOrderItems =array() ;   
        foreach($orderItems as $item){
            foreach($item as $key =>$value){         
                $newOrderItems[$key] = $value;               
                $newOrderItems['order_number'] = $order->order_number;               
                $newOrderItems['order_id'] = $order->id;                          
            } 
            OrderItem::create($newOrderItems) ;            
        }

        event(new orderCreated($order));
        return response()->json([
            'success'=> true,
            'message'=> 'Order created successfuly',
            'data'=> $order,
            ],  201);
    }

    /**
     * mark order complete/cancel item
     * 
     * @param $id $value
     * 
     * @return response
     */
    public function markOrder($id, $value, $date){ 
        if($value =='completed') $order= Order::WHERE('id', $id)->first()->update([
            'status' => $value,
            'completed_at' => $date,
            ]);
        if($value =='canceled') $order= Order::WHERE('id', $id)->first()->update([
            'status' => $value,
            'canceled_at' => $date,
            ]);
        if($value =='delivered') $order= Order::WHERE('id', $id)->first()->update([
            'status' => $value,
            'delivered_at' => $date,
            ]);
        if($value =='processing') $order= Order::WHERE('id', $id)->first()->update([
            'status' => $value,
            ]);
        
        return response()->json([
           'success' => true,
           'message' => 'Order marked ' . $value,
           'data' => true,
        ], 200);        
    }
    /**
     * mark order as paid item
     * 
     * @param $id $amount
     * 
     * @return response
     */
    public function markOrderPaid($id, $amount, $date){
        $order= Order::WHERE('id', $id)->first()->update([
            'paid' => 'true',
            'transaction_id' => 'cash',
            'amount_paid' => $amount,
            'paid_at' => $date,
            ]);
        return response()->json([
            'success' => true,
           'message' => 'Order marked  as paid',
           'data' => true,
        ], 200);        
    }
    /**
     * mark order as paid item
     * 
     * @param $id $amount
     * 
     * @return response
     */
    public function markOrderCollectCash($id, $amount, $date){
        $order= Order::WHERE('id', $id)->first()->update([
            'cash_collected' => 'true',
            'amount_collected' => $amount,
            'cash_collected_at' => $date,
            ]);
        return response()->json([
            'success' => true,
           'message' => 'Order cash collected successfully',
           'data' => true,
        ], 200);        
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
        $order = Order::findOrFail($id);
        event(new orderUpdated($order));
        return response()->json([
            'success'=> true, 
            'message'=>'Order updated successfuly', 
            'data'=>true],  200);
    }

    /**
     * SoftDelete the specified resource from storage.
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
