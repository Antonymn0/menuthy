<?php

namespace App\Listeners\Payment;

use App\Events\Payment\paymentCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PaymentCreatedListener
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
     * @param  \App\Events\Payment\paymentCreated  $event
     * @return void
     */
    public function handle(paymentCreated $event)
    {
        //
    }
}
