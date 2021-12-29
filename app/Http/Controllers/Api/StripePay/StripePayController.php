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
            $data = $event -> data;
            $payment =  array();
                $payment['customer_name'] = $data['object']['billing_details']['name'];
                $payment['email'] = $data['object']['billing_details']['email'];
                $payment['phone'] = $data['object']['billing_details']['phone'];
                $payment['currency'] = $data['object']['currency'];
                $payment['customer_id'] = $data['object']['customer'];
                $payment['paid'] = $data['object']['paid'];
                $payment['payment_intent'] = $data['object']['payment_intent'];
                $payment['payment_method'] = $data['object']['payment_method'];
                $payment['reciept_url'] = $data['object']['receipt_url'];
                $payment['amount_paid'] = $data['object']['amount'];
                return $payment; 
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
