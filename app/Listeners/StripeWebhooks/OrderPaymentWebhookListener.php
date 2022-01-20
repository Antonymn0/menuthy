<?php

namespace App\Listeners\StripeWebhooks;

use App\Events\Stripe\OrderPaymentWebhook;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderPaymentWebhookListener
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
    public function handle(OrderPaymentWebhook $event)
    {
        //
    }
}
