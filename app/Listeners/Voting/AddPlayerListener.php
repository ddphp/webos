<?php

namespace App\Listeners\Voting;

use App\Events\Voting\AddPlayer;
use App\Models\Voting\PlayersContent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddPlayerListener
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
     * @param  AddPlayerListener  $event
     * @return void
     */
    public function handle(AddPlayer $event)
    {
        $player = $event->player;

        $content = PlayersContent::where('players_id', $player->id)->first();
        if (!$content) {
            $content = app(PlayersContent::class);
            $content->players_id = $player->id;
            $content->desc = '';
            $content->detail = '';
            $content->ext = '';
            $content->save();
        }

        $activityCount = $player->activity->activityCount;
        $activityCount->players ++;
        $activityCount->save();
    }
}
