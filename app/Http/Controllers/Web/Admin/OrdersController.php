<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\OrderItem;
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
        $orders = Order::with(['OrderItem'])
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
         $order = Order::with(['OrderItem'])->where('order_number', $order_no)->get();
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
         $order =Order::with(['OrderItem']) -> where('transaction_id', $transaction_id)->get();
         return response()->json([
            'success'=> true,
            'message' => 'Order by transaction id  successful',
            'data'=>$order], 200);
    }

    /**
     * Search order by resaturant email.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchOrdersByResaturantEmail($email)
    { 
        $restaurant = Restaurant::where('restaurant_email', $email)->first();
       
        if(isset($restaurant)){
            $order =Order::with(['OrderItem']) -> where('restaurant_id', $restaurant ->id)->get();
            return response()->json([
                'success'=> true,
                'message' => 'Orders search by restaurant email  successful',
                'data'=>$order], 200);
        }
         return response()->json([
                'success'=> false,
                'message' => 'No results found',
                'data'=>[]], 404);
         
    }


}
