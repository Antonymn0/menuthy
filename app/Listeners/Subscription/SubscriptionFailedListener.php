<?php

namespace App\Listeners\Subscription;

use App\Events\Subscription\SubscriptionFailed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Mail\Subscription\SubscriptionFailedEmail;
use Illuminate\Support\Facades\Mail;

class SubscriptionFailedListener implements shouldQueue
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
     * @param  \App\Events\Subscription\SubscriptionFailed  $event
     * @return void
     */
    public function handle(SubscriptionFailed $event)
    {
        Mail::to($event->payment->email)->send(new SubscriptionFailedEmail($event->payment));
    }
}
