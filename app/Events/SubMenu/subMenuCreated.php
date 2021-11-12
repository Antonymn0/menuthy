<?php

namespace App\Events\SubMenu;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class subMenuCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $subMenu;
    
    /**
     * Create a new event instance.
     *
     * @param $subMenu
     * @return void
     */
    public function __construct($subMenu)
    {
        $this->subMenu = $subMenu;
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
