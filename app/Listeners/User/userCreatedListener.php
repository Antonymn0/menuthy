<?php

namespace App\Listeners\User;

use App\Events\User\userCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\WelcomeEmail;
use App\Mail\ConfirmEmail;
use App\Mail\Admin\NotifyAdminNewUserCreated;
use Illuminate\Support\Facades\Mail;

class userCreatedListener implements shouldQueue
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
     * @param  userCreated  $event
     * @return void
     */
    public function handle(userCreated $event)
    {
            // send welcome email and confirmation emails
          Mail::to($event->user->email)->send(new WelcomeEmail($event->user));
          Mail::to($event->user->email)->send(new ConfirmEmail($event->user));

          // notify admin new user registered email
          Mail::to(env('ADMIN_EMAIL'))->send(new NotifyAdminNewUserCreated($event->user));
    }
}
