<?php

namespace App\Events\Voting;

use App\Models\Voting\Players;
use App\Models\Voting\Voters;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VoteEvents
{
    use InteractsWithSockets, SerializesModels;

    public $Voter;
    public $Player;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Voters $voter,Players $player)
    {
        $this->Voter  = $voter;
        $this->Player = $player;
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
