<?php

namespace App\Events\Voting;

use App\Models\Voting\Players;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DelPlayer
{
    use InteractsWithSockets, SerializesModels;

    public $player;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Players $player)
    {
        $this->player = $player;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
