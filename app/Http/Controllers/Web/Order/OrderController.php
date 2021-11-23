<?php

namespace App\Http\Controllers\Web\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($restaurant_name, $restaurant_id)
    {
        $orders = Order::whereDate('created_at', Carbon::today())
                        ->orderBy('created_at','DESC')
                        ->paginate(ENV('API_PAGINATION', 15));

        return Inertia::render('Order/AllOrders')->with([
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
        $orders = Order::whereDate('created_at', Carbon::today())
                        ->orderBy('created_at','DESC')
                        ->paginate(ENV('API_PAGINATION', 15));

        return response()->json([
                    'success' => true,
                   'message' => 'A list of orders',
                   'data' => $orders,           
               ]); 
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchOrders($restaurant_id, $search_term)
    {         
          // fetch today orders 
        if($search_term == 'today'){
             $orders = Order::whereDate('created_at', Carbon::today())
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
            $orders = Order::WHERE('status', $search_term)
                            ->orderBy('created_at','DESC')
                            ->paginate(ENV('API_PAGINATION', 15)); 
                return response()->json([
                    'success' => true,
                   'message' => 'A list of orders',
                   'data' => $orders,           
               ]); 
        }

       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
