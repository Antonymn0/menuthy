<?php

namespace App\Listeners\StripeWebhooks;

use App\Events\StripeWebhooks\SubscriptionPaymentWebhook;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Stripe\Stripe;
use App\Models\User;
use App\Models\SubscriptionPayment;
use Carbon\Carbon;
use App\Events\Subscription\SubscriptionCreated;
use App\Events\Subscription\SubscriptionFailed;

class SubscriptionPaymentWebhookListener implements shouldQueue
 
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Stripe\SubscriptionPaymentWebhook  $event
     * @return void
     */
    public function handle(SubscriptionPaymentWebhook $event)    
    {   
        $this->handleSubscriptionWebhook( $event->event);
    }

     /**
     * Handle chargesuccessful  events
     * 
     */ 
    public function handleSubscriptionWebhook($event){
        $data = $event -> data;
        $payment =  array();
            $payment['customer_name'] = $data['object']['billing_details']['name'];
            $payment['email'] = $data['object']['billing_details']['email'];
            //$payment['phone'] = $data['object']['billing_details']['phone'];
            $payment['currency'] = $data['object']['currency'];
            $payment['customer_id'] = $data['object']['customer'];
            $payment['paid'] = $data['object']['paid'];
            $payment['payment_intent'] = $data['object']['payment_intent'];
            $payment['payment_method'] = $data['object']['payment_method'];
            $payment['reciept_email'] = $data['object']['receipt_email'];
            $payment['reciept_number'] = $data['object']['receipt_number'];
            $payment['reciept_url'] = $data['object']['receipt_url'];
            $payment['amount_paid'] = $data['object']['amount'] / 100;
            $payment['registration_date'] =Carbon::now();

            $payment_obj = (object) $payment; 

            $payment['package_type'] = $data['object']['metadata']['package_type'];
            $payment['package_period'] = $data['object']['metadata']['package_period'];
            $payment['registration_expiry'] = $this->getRegistrationExpiry($payment_obj);

        if($event->type == 'charge.succeeded'){
            $subscription = SubscriptionPayment::create($payment); // record subscription in subscriptions table
            $this->updateUser($payment);
            event(new SubscriptionCreated($subscription));
            return 'Payment successfull'; 
        } 
        if($event->type == 'charge.failed'){  
            $payment = (object) $payment;         //convert array to object
            event(new SubscriptionFailed($payment));
            return 'Subscription failed';
        } 
        else return 'Unhandled webhook event';        
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
                'package_type' => $payment_obj->package_type,
                'package_period' => $payment_obj->package_period,
                'registration_date'=> carbon::now(),
                'registration_expiry'=> $this->getRegistrationExpiry($payment_obj)
            ]);
        };
    }
    
    /**
     * Return NEW expiry date AFTER subscription
     */
    public function getRegistrationExpiry($payment_obj){
        $days = 0;
        $ex_date = '';

        // monthy subscription
        if($payment_obj->package_period == 'monthly') $days =30;
        
        //yearly subsciption
        if($payment_obj->package_period == 'yearly') $days =365;
       
        $ex_date = Carbon::now()->addDays($days);
        return $ex_date;
    }   

  


}