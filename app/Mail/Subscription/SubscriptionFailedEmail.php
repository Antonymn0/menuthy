<?php

namespace App\Mail\Subscription;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionFailedEmail extends Mailable
{
    use Queueable, SerializesModels;

     public $payment;
    
    /**
     * Create a new event instance.
     *
     * @param $payment
     * @return void
     */
    public function __construct($payment)
    {
        $this->payment = $payment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails/subscription/SubscriptionFailed')->with(['subscription'=>$this->payment]);
    }
}
