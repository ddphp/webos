<?php

namespace App\Events\Voting;

use App\Models\Voting\Activity;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VisitEvents
{
    use InteractsWithSockets, SerializesModels;

    public $activity;
    public $openid;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Activity $activity, $openid)
    {
        $this->activity = $activity;
        $this->openid   = $openid;
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
