<?php

namespace App\Listeners\User;

use App\Events\User\emailVerified;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\PaymentLinkEmail;
use Illuminate\Support\Facades\Mail;

class emailVerifiedListener
{
    public  $user;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\User\emailVerified  $event
     * @return void
     */
    public function handle(emailVerified $event)
    {
        //send payment link
        Mail::to($event->user->email)->send(new PaymentLinkEmail($event->user));
    }
}
