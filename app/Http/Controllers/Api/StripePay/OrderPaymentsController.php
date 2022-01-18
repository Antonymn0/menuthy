<?php

namespace App\Http\Controllers\Api\StripePay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use App\Http\Requests\Order\ValidateOrder;
use App\Events\Order\orderCreated;

class OrderPaymentsController extends Controller
{
    /**
     * order stripe payment.
     * 
     *@param  \Illuminate\Http\Request\ValidateOrder  $request
     * @return \Illuminate\Http\Response
     */
    public function orderCheckout(ValidateOrder $request)
    {  
        $order_data = $request->validated(); 

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
        
        // Initialize stripe pay checkout session
        $apiKey = Stripe::setApiKey($user->stripe_secret_key);
        $stripe = new \Stripe\StripeClient($user->stripe_secret_key);

        $session = $stripe->checkout->sessions->create([
            'success_url' => $url .'/order-payment-success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => $url .'/order-payment-fail',
            'payment_method_types' => ['card'],
            'mode' => 'payment',
            'line_items' => $line_items,
            'metadata' => [
                        'order_number'=> $request->order_number,
                     ]
        ]); 
        $this->storeOrder( $request, $session);
       echo json_encode($session);  
    }
    
    /**
     * Handle stripe order payments webhook call backs
     */
    public function handleOrderWebhook(Request $event){        
        $data = $event -> data;
        if($event->type == 'charge.succeeded') return $data['object']['payment_intent'];
        if($event->type == 'charge.failed') return 'Failed';
        return $data;
    }


    /**
     * Store a newly created order in storage.
     *
     * @param  \Illuminate\Http\Request\ValidateOrder  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOrder(Request $request, $stripe_session)
    {       
        $data = $request->validated();  
        $data['mode_of_payment'] ='stripe';
        $data['stripe_session_id'] =$stripe_session->id;
        $data['stripe_payment_intent_id'] =$stripe_session->payment_intent;
      
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
            OrderItem::create($newOrderItems);            
        }
        event(new orderCreated($order));
        return  true;           
           
    }
    /**
     * successful stripe payment callback route
     */
    public function successful(Request $request){
        // $apiKey = Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        // $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));

        // $session = \Stripe\Checkout\Session::retrieve($request->get('session_id'),['expand'=>[ 'line_items']]);
        // $line_items = $stripe->checkout->sessions->allLineItems($request->get('session_id'), ['limit' => 20]);
       
        return Inertia::render('MobileMenu/SuccessPage');
    }

    /**
    * successful stripe payment callback route
    */
    public function failed(){
        return Inertia::render('MobileMenu/FailedPage');
    } 

}





