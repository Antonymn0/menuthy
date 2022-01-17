<?php

namespace App\Http\Controllers\Api\StripePay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\MenuItem;
use Carbon\Carbon;

class OrderPaymentsController extends Controller
{
    /**
     * order stripe payment.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderCheckout(Request $request)
    { 
        $restaurant =  Restaurant::findOrFail($request->restaurant_id);
        // get user object associated with the restaurant 
        $user = User::findOrfail($restaurant->user_id); 
        if(!isset($request)) return;
        if(!isset($restaurant)) return;
        if(!isset($user)) return;
        $url = url('');
        $order_items = json_decode($request->order_items);
        $current_order_items = []; 
        $line_items =[];
        // retrieve fresh order records from database 
        foreach ($order_items as $item ) {
            $order_item = MenuItem::findOrFail($item->menu_item_id);

            // start build $line_items for checkout
            $line_item = [];
            $price_data =[];
            $product_data =[];
            // build $price_data
            $price_data['currency'] = strtolower($restaurant->currency);
            $price_data['unit_amount'] = $order_item->price * 100;
            // build $product_data
            $product_data['name'] = $order_item->menu_item_name;
            $product_data['description'] = $order_item->description;
            // push $product_data into $price_data 
            $price_data['product_data'] = $product_data;
            // push $price_data into $line_item
            $line_item['price_data'] = $price_data;
            $line_item['quantity'] = $item->quantity;

            // push $line_item into $line_items 
            array_push($line_items, $line_item); 
            // push $order_item into $current_order_items
            array_push($current_order_items, $order_item);
        }     
        
        // Initialize stripe pay checkout
        $apiKey = Stripe::setApiKey($user->stripe_secret_key);
        $stripe = new \Stripe\StripeClient($user->stripe_secret_key);

        $session = $stripe->checkout->sessions->create([
            'success_url' => $url .'/payment-success',
            'cancel_url' => $url .'/payment-fail',
            'payment_method_types' => ['card'],
            'mode' => 'payment',
            'line_items' => $line_items,
        ]); 
       echo json_encode($session);  
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
