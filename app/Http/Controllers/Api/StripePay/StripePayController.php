<?php

namespace App\Http\Controllers\Api\StripePay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Inertia\Inertia;
use App\Models\User;
use App\Models\SubscriptionPayment;
use Carbon\Carbon;
use App\Events\Subscription\SubscriptionCreated;
use App\Events\Subscription\SubscriptionFailed;
use App\Events\StripeWebhooks\SubscriptionPaymentWebhook;


class StripePayController extends Controller
{     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subscriptionCheckout(Request $request)
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
                        'unit_amount' => $user_data->plan->price * 100 // least curency sub-unit
                    ],
                    'quantity' => 1,
                ],               
            ],
            'metadata'=>[
                'payment_for' => 'subscription payment'
            ],
            'payment_intent_data'=>[
                "metadata"=> [
                        'payment_for' => 'subscription payment',
                        'package_type' => $user_data->plan->type,
                        'package_period' => $user_data->plan->plan_period,
                    ]
            ],
        ]);
        echo json_encode($session);        
    }


    /**
     * Handle charge  events in a handler
     *@param $event
     *@return status true to stripe
     */ 
    public function handleSubscriptionWebhook(Request $event){        
        if($event->type == 'checkout.session.completed') return 'Not a charge.succeeded event';         
        if($event->data['object']['metadata']['payment_for'] !== 'subscription payment')  return 'Not a subscription payment event';
        
        // Transform request $event for serialization
        $new_event = (object) $event->all();
        event(new SubscriptionPaymentWebhook( $new_event ));
        // return 'Charge Successful';                
    }


    /**
     * successful stripe checkout session callback route
     */
    public function successful(){
        return Inertia::render('Subscriptions/SuccessPage');
    }

    /**
    * successful stripe checkout session callback route
    */
    public function failed(){
        return Inertia::render('Subscriptions/FailedPage');
    } 

  
}
