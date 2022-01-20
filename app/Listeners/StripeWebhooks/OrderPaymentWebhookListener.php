<?php

namespace App\Listeners\StripeWebhooks;

use App\Events\Stripe\OrderPaymentWebhook;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\Order;
use Carbon\Carbon;

class OrderPaymentWebhookListener implements shouldQueue
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
     * @param  \App\Events\Stripe\OrderPaymentWebhook  $event
     * @return void
     */
    public function handle( $event)
    {
        $this->handleOrderWebhook( $event->event);
    }


     /**
     * Handle stripe order payments webhook call backs
     */
    public function handleOrderWebhook(Request $event){        
        $data = $event -> data;
        // update order status if charge succeeded
        if($event->type == 'charge.succeeded'){
            $order = Order::where('stripe_payment_intent_id',$data['object']['payment_intent'] )->first();
            if($order->mode_of_payment == 'stripe' && $order->paid == 'true') return;
            $order->update([
                'transaction_id' => $data['object']['payment_intent'],
                'amount_paid' => $data['object']['amount'] / 100,
                'paid_at' => Carbon::now(),
                'paid' => 'true',
                'reciept_url'=> $data['object']['receipt_url'],
            ]);
            return true;
        }
        // update order failed if charge failed
        if($event->type == 'charge.failed'){
            $order = Order::where('stripe_payment_intent_id',$data['object']['payment_intent'] );
            $order->update([
                'transaction_id' => 'Stripe Payment failed to process!'
            ]);
        } 
    }

}
