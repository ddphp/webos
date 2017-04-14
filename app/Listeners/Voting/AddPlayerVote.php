<?php

namespace App\Listeners\Voting;

use App\Events\Voting\VoteEvents;
use App\Models\Voting\Players;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddPlayerVote
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
     * @param  VoteEvents  $event
     * @return void
     */
    public function handle(VoteEvents $event)
    {
        $Player = $event->Player;

        $Player->vote ++;

        $Player->save();
    }
}
