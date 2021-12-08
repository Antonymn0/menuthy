<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\carbon;
use Inertia\Inertia;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllOrders()
    {
         $orders = Order::whereDate('created_at', Carbon::today())
                        ->orderBy('created_at','DESC')
                        ->paginate(ENV('API_PAGINATION', 15));

        return Inertia::render('SuperAdmin/Orders/AllOrders')->with([
            'orders' => $orders,
        ]);
    }

    /**
     * Search order by order no.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchOrderNo($order_no)
    {
         $order = Order::where('order_number', $order_no)->get();
         return response()->json([
            'success'=> true,
            'message' => 'A single order retieved successfully',
            'data'=>$order], 200);
    }

    /**
     * Search order by transaction_id.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchTransactionId($transaction_id)
    {
         $order = Order::where('transaction_id', $transaction_id)->get();
         return response()->json([
            'success'=> true,
            'message' => 'Order by transaction id  successful',
            'data'=>$order], 200);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
