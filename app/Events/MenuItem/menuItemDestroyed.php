<?php

namespace App\Events\MenuItem;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class menuItemDestroyed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $menuItem;
    
    /**
     * Create a new event instance.
     *
     * @param $menuItem
     * @return void
     */
    public function __construct($menuItem)
    {
        $this->menuItem = $menuItem;
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
