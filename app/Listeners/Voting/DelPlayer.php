<?php

namespace App\Listeners\Voting;

use App\Events\Voting\DelPlayer as DelPlayerEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DelPlayer
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
     * @param  DelPlayer  $event
     * @return void
     */
    public function handle(DelPlayerEvent $event)
    {
        $player = $event->player;

        $count = $player->activity->activityCount;

        $count->players --;

        $count->save();
    }
}
