<?php

namespace App\Events\Table;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class tableUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $table;
    
    /**
     * Create a new event instance.
     *
     * @param $table
     * @return void
     */
    public function __construct($table)
    {
        $this->table = $table;
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
