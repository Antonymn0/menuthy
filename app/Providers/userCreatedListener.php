<?php

namespace App\Providers;

use App\Providers\userCreated;
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
     * @param  userCreated  $event
     * @return void
     */
    public function handle(userCreated $event)
    {
        //
    }
}
