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
            ]
        ]);
        echo json_encode($session);        
    }


    /**
     * handle charge  events
     *  */ 
    public function handleSubscriptionWebhook(Request $event){

        // $event = $event->all();
        event(new SubscriptionPaymentWebhook($event->all()));
        return true;
        // $data = $event -> data;
        // $payment =  array();
        //     $payment['customer_name'] = $data['object']['billing_details']['name'];
        //     $payment['email'] = $data['object']['billing_details']['email'];
        //     //$payment['phone'] = $data['object']['billing_details']['phone'];
        //     $payment['currency'] = $data['object']['currency'];
        //     $payment['customer_id'] = $data['object']['customer'];
        //     $payment['paid'] = $data['object']['paid'];
        //     $payment['payment_intent'] = $data['object']['payment_intent'];
        //     $payment['payment_method'] = $data['object']['payment_method'];
        //     $payment['reciept_email'] = $data['object']['receipt_email'];
        //     $payment['reciept_number'] = $data['object']['receipt_number'];
        //     $payment['reciept_url'] = $data['object']['receipt_url'];
        //     $payment['amount_paid'] = $data['object']['amount'] / 100;
        //     $payment['registration_date'] =Carbon::now();

        //     $payment_obj = (object) $payment; 

        //     $payment['package_type'] = $this->getPackageType($payment_obj);
        //     $payment['package_period'] = $this->getPackagePeriod($payment_obj);
        //     $payment['registration_expiry'] = $this->getRegistrationExpiry($payment_obj);


        // if($event->type == 'charge.succeeded'){
        //     $subscription = SubscriptionPayment::create($payment); // record subscription in subscriptions table
        //     $this->updateUser($payment);
        //     event(new SubscriptionCreated($subscription));
        //     return 'Payment successfull'; 
        // } 
        // if($event->type == 'charge.failed'){  
        //     $payment = (object) $payment;         //convert array to object
        //     event(new SubscriptionFailed($payment));
        //     return 'Subscription failed';
        // } 
        // else return 'Unhandled webhook event';        
    }

/**
 * Update user account after successful payment
 */
    public function updateUser($payment){
        $payment_obj = (object) $payment;         //convert array to object
        $user = User::where('email', $payment_obj->email)->first();
        if(isset($user)){
            $user->update([
                'registration_status' => 'subscribed',
                'trial_expiry' => null,
                'package_type' => $this->getPackageType($payment_obj),
                'package_period' => $this->getPackagePeriod($payment_obj),
                'registration_date'=> carbon::now(),
                'registration_expiry'=> $this->getRegistrationExpiry($payment_obj)
            ]);
        };
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

    /**
     * Return NEW expiry date AFTER subscription
     */
    public function getRegistrationExpiry($payment_obj){
        $days = 0;
        $ex_date = '';

        // monthy subscription
        if($payment_obj->amount_paid == 33 || $payment_obj->amount_paid == 66 || $payment_obj->amount_paid == 133 || $payment_obj->amount_paid == 266) $days =30;
        
        //yearly subsciption
        if($payment_obj->amount_paid == 333 || $payment_obj->amount_paid == 777 || $payment_obj->amount_paid == 1333 || $payment_obj->amount_paid == 2777) $days =365;
       
        $ex_date = Carbon::now()->addDays($days);
        return $ex_date;
    }   

    /**
     * Return package period AFTER subscription
     */
    public function getPackagePeriod($payment_obj){
        $period = '';        

        // monthy subscription
        if($payment_obj->amount_paid == 33 || $payment_obj->amount_paid == 66 || $payment_obj->amount_paid == 133 || $payment_obj->amount_paid == 266) $period = 'Monthly';
        
        //yearly subsciption
        if($payment_obj->amount_paid == 333 || $payment_obj->amount_paid == 777 || $payment_obj->amount_paid == 1333 || $payment_obj->amount_paid == 2777) $period = 'Yearly';
       
        return $period;
    }   

    /**
     * return package type after successful subscription
     */
    public function getPackageType($payment_obj){
        $package_type ='';
            // monthly 
        if($payment_obj->amount_paid == 33 ) $package_type = 'Starter';
        if($payment_obj->amount_paid == 66 ) $package_type = 'Lite';
        if($payment_obj->amount_paid == 133 ) $package_type = 'Pro';
        if($payment_obj->amount_paid == 266 ) $package_type = 'Premium';        
        
        //yearly
        if($payment_obj->amount_paid == 333 ) $package_type = 'Starter';
        if($payment_obj->amount_paid == 777) $package_type = 'Lite';
        if($payment_obj->amount_paid == 1333 ) $package_type = 'Pro';
        if($payment_obj->amount_paid == 2777 ) $package_type = 'Premium';


        return $package_type;
    }
}
