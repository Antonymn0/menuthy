<?php

namespace App\Mail\Subscription;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionFailedEmail extends Mailable
{
    use Queueable, SerializesModels;

     public $subscription;
    
    /**
     * Create a new event instance.
     *
     * @param $subscription
     * @return void
     */
    public function __construct($subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails/subscription/SubscriptionFailed')->with(['subscription'=>$this->subscription]);
    }
}
