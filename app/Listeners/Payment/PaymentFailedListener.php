<?php

namespace App\Listeners\Payment;

use App\Events\Payment\paymentFailed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PaymentFailedListener implements shouldQueue
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
     * @param  \App\Events\Payment\paymentFailed  $event
     * @return void
     */
    public function handle(paymentFailed $event)
    {
        //
    }
}
