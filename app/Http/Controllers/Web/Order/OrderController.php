<?php

namespace App\Http\Controllers\Web\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Restaurant;
use Carbon\Carbon;
use PDF;


class OrderController extends Controller
{
    /**
     * Display orders to the kitchen.
     *
     * @return \Illuminate\Http\Response
     */
    public function kitchenOrders($restaurant_name, $restaurant_id)
    {
        $orders = Order::with(['OrderItem'])
                    ->WHERE('restaurant_id', $restaurant_id)
                    ->orderBy('created_at','DESC')
                    ->paginate(ENV('API_PAGINATION', 15));
        return Inertia::render('Order/KitchenOrders')->with([
            'orders' => $orders,
        ]);
    }

    /**
     * Display orders to cashier.
     *
     * @return \Illuminate\Http\Response
     */
    public function cashierOrders($restaurant_name, $restaurant_id)
    {
        $orders = Order::with(['OrderItem'])
                    ->WHERE('restaurant_id', $restaurant_id)                    
                    ->orderBy('created_at','DESC')
                    ->paginate(ENV('API_PAGINATION', 15));
        return Inertia::render('Order/CashierOrders')->with([
            'orders' => $orders,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function refreshOrders($restaurant_name, $restaurant_id)
    {
        $orders = Order::with(['OrderItem'])
                        ->WHERE('restaurant_id', $restaurant_id)
                        ->orderBy('created_at','DESC')
                        ->paginate(ENV('API_PAGINATION', 15));

        return response()->json([
                    'success' => true,
                   'message' => 'A list of orders',
                   'data' => $orders,           
               ]); 
    }


    /**
     * fetch orders by statusy.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchOrders($restaurant_id, $search_term)
    {         
          // fetch all today orders 
        if($search_term == 'today'){
             $orders = Order::with(['OrderItem'])
                            ->WHERE('restaurant_id', $restaurant_id)
                            ->orderBy('created_at','DESC')
                            ->paginate(ENV('API_PAGINATION', 15));
                return response()->json([
                   'success' => true,
                   'message' => 'A list of orders',
                   'data' => $orders,           
               ]);                         
        }
        else{
            // fetch orders according to provided search term 
            $orders = Order::with(['OrderItem'])
                            ->WHERE('restaurant_id', $restaurant_id)
                            -> WHERE('status', $search_term)
                            ->orderBy('created_at','DESC')
                            ->paginate(ENV('API_PAGINATION', 15)); 
                return response()->json([
                    'success' => true,
                   'message' => 'A list of orders',
                   'data' => $orders,           
               ]); 
        }

       
    }

 // fetch order types depending on the search term
public function fetchOrderTypes($restaurant_id, $order_type){
        // fetch orders according to provided search term        
            $orders = Order::with(['OrderItem'])
                        ->WHERE('restaurant_id', $restaurant_id)
                        ->WHERE('order_type', $order_type)
                        ->orderBy('created_at','DESC')
                        ->paginate(ENV('API_PAGINATION', 15)); 

                return response()->json([
                    'success' => true,
                   'message' => 'A list of order types',
                   'data' => $orders,           
               ]); 
}

 // fetch order types depending on the table
public function fetchOrderTables($restaurant_id, $table_no){
        // fetch orders according to provided search term 
       
            $orders = Order::with(['OrderItem'])
                        ->WHERE('restaurant_id', $restaurant_id)
                        ->WHERE('table_number', $table_no)
                        ->orderBy('created_at','DESC')
                        ->paginate(ENV('API_PAGINATION', 15)); 

                return response()->json([
                    'success' => true,
                   'message' => 'A list of orders by tables',
                   'data' => $orders,           
               ]); 
}

 // fetch orders depending on the date
public function fetchOrderBydate($restaurant_id, $date){
        // fetch orders according to provided date       
            $orders = Order::with(['OrderItem'])
                        ->WHERE('restaurant_id', $restaurant_id)
                        ->whereDate('created_at', $date)
                        ->orderBy('created_at','DESC')
                        ->paginate(ENV('API_PAGINATION', 15)); 

                return response()->json([
                    'success' => true,
                   'message' => 'A list of orders by date',
                   'data' => $orders,           
               ]); 
}

 // print orders depending on the date
public function printOrders($restaurant_id){
        $restaurant= Restaurant::where('id', $restaurant_id)->first();

        $startDate = Carbon::now()->subDays(7);
        $endDate = Carbon::now();

        $orders = Order::with(['OrderItem'])
                    ->WHERE('restaurant_id', $restaurant_id)
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->orderBy('created_at','DESC')
                    ->get(); 
        if(!count($orders) ) return 'No orders to print';

        $pdf = PDF::loadView('pdf.ordersPDF', compact('orders', 'restaurant'));
        return $pdf->stream('pdf.ordersPDF');

}
  

}
