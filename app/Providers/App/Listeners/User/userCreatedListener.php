<?php

namespace App\Providers\App\Listeners\User;

use App\Providers\App\Events\User\userCreate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class userCreatedListener
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
     * @param  userCreate  $event
     * @return void
     */
    public function handle(userCreate $event)
    {
        //
    }
}
