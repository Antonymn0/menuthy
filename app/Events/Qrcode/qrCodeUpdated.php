<?php

namespace App\Events\Qrcode;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class qrCodeUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $qrCode;
    
    /**
     * Create a new event instance.
     *
     * @param $qrCode
     * @return void
     */
    public function __construct($qrCode)
    {
        $this->qrCode = $qrCode;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
