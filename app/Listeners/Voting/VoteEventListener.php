<?php

namespace App\Listeners\Voting;

use App\Events\Voting\VoteEvents;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VoteEventListener
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
        $Voter = $event->Voter;

        $Count = $Voter->activity->activityCount;

        $Count->voters ++;

        $Count->save();
    }
}
