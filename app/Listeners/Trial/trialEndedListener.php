<?php

namespace App\Listeners\Trial;

use App\Events\Trial\trialEnded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Mail\Trial\MenuthyTrialEndingToday;
use Illuminate\Support\Facades\Mail;

class trialEndedListener implements ShouldQueue
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
     * @param  \App\Events\Trial\trialEnded  $event
     * @return void
     */
    public function handle(trialEnded $event)
    {
        // notify user that his trial has ended
          Mail::to($event->user->email)->send(new MenuthyTrialEndingToday($event->user));
    }
}
