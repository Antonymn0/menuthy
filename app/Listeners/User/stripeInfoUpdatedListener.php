<?php

namespace App\Listeners\User;

use App\Events\User\stripeInfoUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Mail\User\StripePaymentInfoUpdated;
use Illuminate\Support\Facades\Mail;

class stripeInfoUpdatedListener 
{
    public  $user;

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
     * @param  \App\Events\User\stripeInfoUpdated  $event
     * @return void
     */
    public function handle(stripeInfoUpdated $event)
    {
        // send welcome email and confirmation emails
        Mail::to($event->user->email)->send(new StripePaymentInfoUpdated($event->user));
    }
}
