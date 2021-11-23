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
        $orders =Order::WHERE('restaurant_id', $restaurant_id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(ENV('API_PAGINATION', 15));

        return Inertia::render('Order/AllOrders')->with([
            'orders' => $orders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchOrders($restaurant_id, $search_term)
    {

        // fetch today order 
        if($search_term == 'today'){
            dd($restaurant_id);
            $orders = Order::WHERE('restaurant_id', $restaurant_id)
            
                    // ->WHERE('created_at', Carbon::today())
                    ->get();
                    // ->paginate(ENV('API_PAGINATION', 15));
                 return Inertia::render('Order/AllOrders')->with([
                    'orders' => $orders,
                ]);    
        }
        else{
             dd($restaurant_id);
            // fetch orders according to provided search term 
            $orders = Order::WHERE('restaurant_id', $restaurant_id)
                    // ->WHERE('created_at', Carbon::today())
                    // ->WHERE('status', $search_term)
                    ->get();                    
                    // ->paginate(ENV('API_PAGINATION', 15));
                    return Inertia::render('Order/AllOrders')->with([
                    'orders' => $orders,
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
