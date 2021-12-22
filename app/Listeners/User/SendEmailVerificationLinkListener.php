<?php

namespace App\Listeners\User;

use App\Events\User\SendEmailVerificationLink;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\ConfirmEmail;
use Illuminate\Support\Facades\Mail;

class SendEmailVerificationLinkListener implements shouldQueue
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
     * @param  \App\Events\User\SendEmailVerificationLink  $event
     * @return void
     */
    public function handle(SendEmailVerificationLink $event)
    {
        Mail::to($event->user->email)->send(new ConfirmEmail($event->user));
    }
}
