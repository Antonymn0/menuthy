<?php

namespace App\Listeners\Subscription;

use App\Events\Subscription\SubscriptionCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Mail\Subscription\SubscriptionSuccessful;
use Illuminate\Support\Facades\Mail;

class SubscriptionCreatedListener
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
     * @param  \App\Events\Subscription\SubscriptionCreated  $event
     * @return void
     */
    public function handle(SubscriptionCreated $event)
    {
        Mail::to($event->subscription->email)->send(new SubscriptionSuccessful($event->subscription));
    }
}
