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
use App\Events\StripeWebhooks\OrderPaymentWebhook;

class OrderPaymentsController extends Controller
{
    /**
     * order stripe payment check out session.
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
            'cancel_url' => $url .'/order-payment-fail/'.$request->restaurant_id . '/' . $request->table_number . '/' . $request->order_number,
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

        // transform request $event for serialization
        $new_event = (object) $event->all(); 
        event(new OrderPaymentWebhook( $new_event ));
        return true;  

        // $data = $event -> data;
        // // update order status if charge succeeded
        // if($event->type == 'charge.succeeded'){
        //     $order = Order::where('stripe_payment_intent_id',$data['object']['payment_intent'] )->first();
        //     if($order->mode_of_payment == 'stripe' && $order->paid == 'true') return;
        //     $order->update([
        //         'transaction_id' => $data['object']['payment_intent'],
        //         'amount_paid' => $data['object']['amount'] / 100,
        //         'paid_at' => Carbon::now(),
        //         'paid' => 'true',
        //         'reciept_url'=> $data['object']['receipt_url'],
        //     ]);
        //     return true;
        // }
        // // update order failed if charge failed
        // if($event->type == 'charge.failed'){
        //     $order = Order::where('stripe_payment_intent_id',$data['object']['payment_intent'] );
        //     $order->update([
        //         'transaction_id' => 'Stripe Payment failed to process!'
        //     ]);
        // } 
    }


    /**
     * Store a newly created order in storage after stripe session is created.
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
     * successful stripe ceckout session callback route
     */
    public function successful(Request $request){;
        $order = Order::where('stripe_session_id', $request->get('session_id'))->first();
       $link =  '/restaurant/menu/' . $order->restaurant_id . '/' . $order->table_number;
       $link =url($link);
        return Inertia::render('MobileMenu/SuccessPage', ['order'=>$order, 'link' => $link]);
    }

    /**
    * failed stripe checkout session callback route
    */
    public function failed($restaurant_id, $table_number, $order_number){
        $order = Order::where('order_number', $order_number)->first();
        $link =  '/restaurant/menu/' . $restaurant_id . '/' . $table_number;
        $link = url($link) ;
        return Inertia::render('MobileMenu/FailedPage',['link' => $link, 'order' => $order]); 
       
    } 

    /**
     * Force stripe session expire if user cancels checkout session
     */
    public function forceStripeSessionExpire ($restaurant_id, $stripe_session_id){
        $restaurant = Restaurant::findOrFail($restaurant_id);
        $user = User::findOrFail($restaurant->user_id);
        $stripe = new \Stripe\StripeClient( $user->stripe_secret_key  );
        $stripe->checkout->sessions->expire( $stripe_session_id, [] );
        return response()->json([
            'success' => true,
            'message' => 'Stripe checkout session forced expire successfully ',
            'data' => true
        ], 200);
    }

}





