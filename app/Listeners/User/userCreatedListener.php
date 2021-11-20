<?php

namespace App\Listeners\User;

use App\Events\User\userCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\WelcomeEmail;
use App\Mail\ConfirmEmail;
use Illuminate\Support\Facades\Mail;

class userCreatedListener
{

    
    /**
     * Create a new event instance.
     *
     * @param $user
     * @return void
     */
    public function __construct()
    {

    }


    /**
     * Handle the event.
     *
     * @param  userCreated  $event
     * @return void
     */
    public function handle(userCreated $event)
    {

      //  Mail::to($event->user->email)->send(new WelcomeEmail($event->user));
      //  Mail::to($event->user->email)->send(new ConfirmEmail($event->user));
    }
}
