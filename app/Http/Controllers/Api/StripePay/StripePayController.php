<?php

namespace App\Http\Controllers\Api\StripePay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Inertia\Inertia;
use App\Models\User;
use App\Models\SubscriptionPayment;
use Carbon\Carbon;

class StripePayController extends Controller
{ 
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {     
        if(!isset($request->user_data)) return;
        $url = url('');
        $user_data = json_decode($request->user_data);

        $apiKey = Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));

        $session = $stripe->checkout->sessions->create([
            'success_url' => $url .'/payment-success',
            'cancel_url' => $url .'/payment-fail',
            'payment_method_types' => ['card'],
            'mode' => 'payment',
            'line_items' => [
                [
                    'price_data'=>[
                        'currency' => 'qar',
                        'product_data' => [
                            'name' => $user_data->plan->name,
                            'description' => $user_data->plan->description,
                        ],
                        'unit_amount' => $user_data->plan->price * 100
                    ],
                    'quantity' => 1,
                ],               
            ]
        ]);

        echo json_encode($session);        
    }



    /**
     * return subscription expiry date
     */
    public function getExpiryDate($subscription_period){
        if(isset($subscription_period)){
            $days = 0;
            if($subscription_period == 'monthly') $days = 30; 
            if($subscription_period == 'yearly') $days = 365; 

            return Carbon::now()->addDays($days);
        }
    }

    /**
     * handle charge  events
     *  */ 
    public function handleChargeEvents(Request $event){
        if($event->type == 'charge.succeeded'){
            $payment =  array();
               // $payment['customer_name'] = $event->data->object->name;
                // $payment['email'] = $event->data->object->email;
                // $payment['phone'] = $event->data->object->phone;
                // $payment['currency'] = $event->data->currency;
                // $payment['customer_id'] = $event->data->customer;
                // $payment['paid'] = $event->data->paid;
                // $payment['payment_intent'] = $event->data->payment_intent;
                // $payment['payment_method'] = $event->data->payment_method;
                // $payment['reciept_url'] = $event->data->reciept_url;
                $payment['amount_paid'] = $event->data->object->amount;
           return $event; 
        } 
        if($event->type == 'charge.failed') return $event->type;
        else return 'Unkown webhook event';
        
    }


    /**
     * successful stripe payment callback route
     */
    public function successful(){
        return Inertia::render('Subscriptions/SuccessPage');
    }

    /**
     * successful stripe payment callback route
     */
    public function failed(){
        return Inertia::render('Subscriptions/FailedPage');
    }    

}
